<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Invoice;
use App\Services\Sunat\InvoiceService;
use App\Services\Sunat\UtilService;
use Greenter\Report\XmlUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class VoucherTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['id', 'tipoDoc', 'serie', 'correlativo', 'tipoMoneda']);
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Fecha", "fechaEmision")
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                })
                ->sortable(),

            Column::make('Comprobante')
                ->label(
                    function ($row) {
                        $tipoDoc = match ($row->tipoDoc) {
                            '01' => 'Factura',
                            '03' => 'Boleta',
                            '07' => 'Nota de crédito',
                            '08' => 'Nota de débito',
                            '09' => 'Guía de remisión',
                            default => 'Otro',
                        };

                        return $tipoDoc . ': ' . $row->serie . '-' . $row->correlativo;
                    }
                )
                ->searchable(function ($query, $search) {

                    $search = explode('-', $search);

                    if (count($search) === 1) {
                        $query->orWhere('serie', 'like', '%' . $search[0] . '%')
                            ->orWhere('correlativo', 'like', '%' . $search[0] . '%');

                        return;
                    }

                    $query->orWhere(function ($query) use ($search) {
                        $query->where('serie', 'like', '%' . $search[0] . '%')
                            ->where('correlativo', 'like', '%' . $search[1] . '%');
                    });
                                                
                }),

            Column::make("Cliente", "client")
                ->format(
                    function ($value) {

                        $numDoc = $value['numDoc'] ?? 'S/D';
                        $rznSocial = Str::limit($value['rznSocial'] ?? 'S/D', 30);

                        return $numDoc . '<br>' . $rznSocial;
                    }
                )
                //Buscar por numDoc o rznSocial en el campo de tipo json
                ->searchable(function ($query, $search) {
                    $query->orWhere('client->numDoc', 'like', '%' . $search . '%')
                        ->orWhereRaw("LOWER(json_unquote(json_extract(client, '$.rznSocial'))) LIKE ?", ['%' . strtolower($search) . '%']);
                        
                })
                ->html(),

            Column::make("Monto", "mtoImpVenta")
                ->format(function ($value, $row) {
                    return $row->tipoMoneda . ' ' . number_format($value, 2);
                })
                ->sortable(),

            Column::make('PDF', 'pdf_path')
                ->format(
                    fn ($value, $row) => view('vouchers.partials.pdf', compact('row'))
                )->collapseOnTablet(),

            Column::make('XML', 'xml_path')
                ->format(
                    fn ($value, $row) => view('vouchers.partials.xml', compact('value', 'row'))
                )->collapseOnTablet(),

            Column::make('CDR', 'cdr_path')
                ->format(
                    fn ($value, $row) => view('vouchers.partials.cdr', compact('value', 'row'))
                )->collapseOnTablet(),

            Column::make('Sunat', 'sunatResponse')
                ->format(
                    fn ($value, $row) => view('vouchers.partials.response', compact('value', 'row'))
                )->collapseOnTablet()
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Documentos')
                ->options([
                    '' => 'Todos',
                    '01' => 'Factura',
                    '03' => 'Boleta',
                    '07' => 'Nota de Crédito',
                    '08' => 'Nota de Débito',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('tipoDoc', $value);
                }),

            //Filtro por fecha
            DateRangeFilter::make('Fecha')
                ->config([
                    'altFormat' => 'F j, Y', // Date format that will be displayed once selected
                    'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
                    'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                    'placeholder' => 'Introduzca el rango de fechas', // A placeholder value
                    'locale' => 'es',
                ])
                ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                    $builder
                        ->whereDate('fechaEmision', '>=', $dateRange['minDate']) // minDate is the start date selected
                        ->whereDate('fechaEmision', '<=', $dateRange['maxDate']); // maxDate is the end date selected
                }),
        ];
    }

    //Métodos
    public function downloadPDF(Invoice $invoice)
    {
        return Storage::download($invoice->pdf_path);
    }

    public function downloadXML(Invoice $invoice)
    {
        return Storage::download($invoice->xml_path);
    }

    public function sendXml(Invoice $invoice)
    {
        $directory = $invoice->production ? 'sunat/' : 'sunat/beta/';
        $name = session('company')->ruc."-{$invoice->tipoDoc}-". $invoice->serie.'-'. $invoice->correlativo;

        try {

            $util = new UtilService(session('company'));
            $see = $util->getSee();
            $result = $see->sendXmlFile($invoice->xml);

            if (!$result->isSuccess()) {

                $invoice->sunatResponse = $util->getErrorResponse($result);
                $invoice->save();

                $this->showResponse($invoice);

                return;
            }

            // Guardamos el CDR
            $invoice->cdr_path = $directory . 'cdr/R-' . $name . '.zip';
            Storage::put($invoice->cdr_path, $result->getCdrZip());

            $cdr = $result->getCdrResponse();
            $invoice->sunatResponse = $util->readCdr($cdr);
            $invoice->save();

            $this->showResponse($invoice);

        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Error al enviar el comprobante',
                'text' => $e->getMessage()
            ]);
        }
        
    }

    public function downloadCDR(Invoice $invoice)
    {
        return Storage::download($invoice->cdr_path);
    }

    public function showResponse(Invoice $invoice)
    {
        $title = 'Detalle de la ';
        $title .= match ($invoice->tipoDoc) {
            '01' => 'factura',
            '03' => 'boleta',
            '07' => 'nota de crédito',
            '08' => 'nota de débito',
            default => 'Otro',
        };

        $html = view('vouchers.partials.sunatResponse', [
            'document' => $invoice
        ])->render();

        $this->dispatch('swal', [
            'icon' => $invoice->sunatResponse['success'] ? 'info' : 'error',
            'title' => $title,
            'html' => $html
        ]);
    }

    //Consulta
    public function builder(): Builder
    {
        return Invoice::query()
            ->where('company_id', session('company')->id)
            ->where('production', session('company')->production);
    }
}
