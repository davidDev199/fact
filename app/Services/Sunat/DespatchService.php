<?php

namespace App\Services\Sunat;

use App\Traits\Sunat\UtilTrait;
use DateTime;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Despatch\Direction;
use Greenter\Model\Despatch\Driver;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Despatch\Vehicle;

class DespatchService
{
    use UtilTrait;

    public function getSeeApi()
    {
        $api = new \Greenter\Api($this->company->production ? [
            'auth' => 'https://api-seguridad.sunat.gob.pe/v1',
            'cpe' => 'https://api-cpe.sunat.gob.pe/v1',
        ] : [
            'auth' => 'https://gre-test.nubefact.com/v1',
            'cpe' => 'https://gre-test.nubefact.com/v1',
        ]);

        return $api->setBuilderOptions([
            'strict_variables' => true,
            'optimizations' => 0,
            'debug' => true,
            'cache' => false,
        ])
            ->setApiCredentials(
                $this->company->production ? $this->company->client_id : 'test-85e5b0ae-255c-4891-a595-0b98c65c9854',
                $this->company->production ? $this->company->client_secret : 'test-Hty/M6QshYvPgItX2P0+Kw=='
            )
            ->setClaveSOL(
                $this->company->ruc,
                $this->company->production ? $this->company->user_sol : 'MODDATOS',
                $this->company->production ? $this->company->password_sol : 'MODDATOS'
            )
            ->setCertificate($this->company->certificate);
    }

    public function getDespatch($data)
    {
        return (new Despatch())
            ->setVersion($data['version'] ?? '2022')
            ->setTipoDoc($data['tipoDoc']) // Guia de Remision - Catalog. 09s
            ->setSerie($data['serie'])
            ->setCorrelativo($data['correlativo'])
            ->setFechaEmision(new DateTime($data['fechaEmision'] ?? null))
            ->setCompany($this->getCompany())
            ->setDestinatario($this->getClient($data['destinatario']))
            ->setEnvio($this->getEnvio($data['envio']))
            ->setDetails($this->getDespatchDetails($data['details']));
    }

    public function getEnvio($envio)
    {

        $indicadores = $envio['indicadores'] ?? [];

        $shipment = (new Shipment())
            ->setCodTraslado($envio['codTraslado']) // Cat.20 - Venta
            ->setModTraslado($envio['modTraslado']) // Cat.18 - Transp. Publico
            ->setFecTraslado(new DateTime($envio['fecTraslado']))
            ->setPesoTotal($envio['pesoTotal'])
            ->setUndPesoTotal($envio['undPesoTotal'])

            ->setLlegada($this->getDirection($envio['llegada'], $envio['codTraslado']))
            ->setPartida($this->getDirection($envio['partida'], $envio['codTraslado']));

        if ($envio['modTraslado'] == '01') {
            $shipment->setTransportista($this->getTransportista($envio['transportista']));

            if (in_array('SUNAT_Envio_IndicadorTrasladoVehiculoM1L', $indicadores)) {
                $key = array_search('SUNAT_Envio_IndicadorTrasladoVehiculoM1L', $indicadores);
                unset($indicadores[$key]);
            }
        }

        if ($envio['modTraslado'] == '02') {

            if (!in_array('SUNAT_Envio_IndicadorTrasladoVehiculoM1L', $indicadores)) {
                $shipment->setVehiculo($this->getVehiculo($envio['vehiculo']))
                    ->setChoferes($this->getChoferes($envio['choferes']));
            }
        }

        $shipment->setIndicadores($indicadores);

        return $shipment;
    }

    public function getDirection($data, $codTraslado)
    {
        $direction = new Direction($data['ubigueo'], $data['direccion']);

        if ($codTraslado == '04') {
            $direction->setRuc($data['ruc'] ?? null)
                ->setCodLocal($data['codLocal'] ?? null);
        }

        return $direction;
    }

    public function getTransportista($transportista)
    {
        return (new Transportist())
            ->setTipoDoc($transportista['tipoDoc'])
            ->setNumDoc($transportista['numDoc'])
            ->setRznSocial($transportista['rznSocial'])
            ->setNroMtc($transportista['nroMtc']);
    }

    public function getVehiculo($vehiculo)
    {

        $secundarios = [];

        foreach ($vehiculo['secundarios'] ?? [] as $item) {
            $secundarios[] = (new Vehicle())
                ->setPlaca(strtoupper($item['placa']));
        }

        return (new Vehicle())
            ->setPlaca(strtoupper($vehiculo['placa']))
            ->setSecundarios($secundarios);
    }

    public function getChoferes($choferes)
    {
        $choferes = collect($choferes);

        $drivers = [];

        $drivers[] = (new Driver)
            ->setTipo('Principal')
            ->setTipoDoc($choferes->first()['tipoDoc'])
            ->setNroDoc($choferes->first()['nroDoc'])
            ->setLicencia($choferes->first()['licencia'])
            ->setNombres($choferes->first()['nombres'])
            ->setApellidos($choferes->first()['apellidos']);

        foreach ($choferes->slice(1) as $item) {
            $drivers[] = (new Driver)
                ->setTipo('Secundario')
                ->setTipoDoc($item['tipoDoc'])
                ->setNroDoc($item['nroDoc'])
                ->setLicencia($item['licencia'])
                ->setNombres($item['nombres'])
                ->setApellidos($item['apellidos']);
        }

        return $drivers;
    }

    public function getDespatchDetails($details)
    {
        $greenDetails = [];

        foreach ($details as $item) {
            $greenDetails[] = (new DespatchDetail)
                ->setCantidad($item['cantidad'])
                ->setUnidad($item['unidad'])
                ->setDescripcion($item['descripcion'])
                ->setCodigo($item['codigo']);
        }

        return $greenDetails;
    }
}
