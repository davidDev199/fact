<div>
    <x-wire-card>
        <div class="grid grid-cols-2 xl:grid-cols-5 gap-4 mb-4">

            <!-- Tipo Comprobante -->
            <div class="col-span-1">
                <x-label>
                    Tipo Comprobante
                </x-label>

                <x-select wire:model.live="note.tipoDoc" class="w-full">
                    <option value="07">
                        NOTA DE CREDITO
                    </option>
                    <option value="08">
                        NOTA DE DEBITO
                    </option>
                </x-select>
            </div>

            {{-- Serie --}}
            <div class="col-span-1">
                <x-label>
                    Serie
                </x-label>

                <x-select wire:model="note.serie" class="w-full">

                    @forelse ($series as $serie)
                        <option value="{{ $serie->name }}">
                            {{ $serie->name }}
                        </option>
                    @empty

                        <option value="">
                            No hay series disponibles
                        </option>
                    @endforelse

                </x-select>
            </div>

            {{-- Correlativo --}}
            <div class="col-span-1">
                <x-label>
                    Correlativo
                </x-label>

                <x-input class="w-full" wire:model="note.correlativo" disabled />
            </div>

            {{-- Moneda --}}
            <div class="col-span-1">
                <x-label>
                    Moneda
                </x-label>

                <x-select wire:model="note.tipoMoneda" class="w-full">
                    <option value="PEN">
                        Soles
                    </option>
                    <option value="USD">
                        Dolares
                    </option>
                </x-select>
            </div>

            {{-- Fecha --}}
            <div class="col-span-1">
                <x-label>
                    Fecha
                </x-label>

                <x-input wire:model="note.fechaEmision" type="date" class="w-full" />
            </div>

            {{-- Codigo motivo --}}
            <div class="col-span-1">
                <x-label>
                    Codigo Motivo
                </x-label>

                <x-select wire:model.live="note.codMotivo" class="w-full">

                    @foreach ($reasons as $reason)
                        <option value="{{ $reason->id }}">
                            {{ Str::limit($reason->description, 60) }}
                        </option>
                    @endforeach

                </x-select>

            </div>

            {{-- Cliente --}}
            <div class="col-span-2 xl:col-span-3">

                <x-label>
                    Cliente
                </x-label>

                <x-wire-select class="!text-sm" placeholder="Buscar cliente por numero de documento o razón social"
                    :async-data="[
                        'api' => route('api.clients.index'),
                        'method' => 'POST',
                    ]" option-label="name" option-value="id" wire:model.live="client_id" />

            </div>

            {{-- Nuevo Cliente --}}
            <div class="col-span-2 xl:col-span-1">
                <x-wire-button x-on:click="$openModal('clientCreationModal')" class="w-full xl:mt-5.5">
                    NUEVO CLIENTE
                </x-wire-button>
            </div>

            {{-- Producto --}}
            <div class="col-span-2 xl:col-span-4">
                <x-label>
                    Producto
                </x-label>

                <x-wire-select placeholder="Buscar producto por código o descripción" :async-data="[
                    'api' => route('api.products.index'),
                    'method' => 'POST',
                ]"
                    option-label="name" option-value="id" wire:model.live="product_id" />
            </div>

            {{-- Boton item detallado --}}
            <div class="col-span-2 xl:col-span-1">
                <x-wire-button x-on:click="$openModal('simpleModal')" class="w-full xl:mt-5.5">
                    ITEM DETALLADO
                </x-wire-button>
            </div>

            {{-- Documento que modifica --}}
            <div class="col-span-2 xl:col-span-5">

                <div class="flex justify-center items-center space-x-4">
                    <x-label class="whitespace-nowrap">
                        Documento Afectado
                    </x-label>
    
                    <x-input class="w-36"
                        wire:model="note.numDocfectado"
                        placeholder="Ejm: F001-111" />
                </div>

            </div>

        </div>

        {{-- Detail --}}
        <div class="overflow-x-auto mt-4 min-h-48">
            @if (count($note->details))

                <table class="w-full text-left text-sm border-separate border-spacing-2">
                    <thead>
                        <tr class="uppercase text-gray-400">
                            <th>Cantidad</th>
                            <th>Código</th>
                            <th class="p-2">Descripción</th>

                            <th>V.Unit</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($note->details as $key => $item)
                            <tr wire:key="detail-{{ $key }}">
                                <td>
                                    <x-input wire:change="recalculateDetail({{ $key }})"
                                        wire:model="note.details.{{ $key }}.cantidad" class="w-20"
                                        type="number" min="1" />
                                </td>
                                <td>
                                    <x-input disabled value="{{ $item['codProducto'] }}" class="w-28" />
                                </td>
                                <td class="w-full">
                                    <x-input disabled value="{{ $item['descripcion'] }}" class="w-full" />
                                </td>
                                <td>
                                    <x-input disabled value="{{ $item['mtoValorUnitario'] }}" class="w-28"
                                        type="number" />
                                </td>
                                <td>
                                    <x-input disabled value="{{ $item['mtoValorUnitario'] * $item['cantidad'] }}"
                                        class="w-28" type="number" />
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <x-wire-mini-button green 
                                            wire:click="editDetail({{ $key }})"
                                            spinner="editDetail({{ $key }})"
                                            icon="pencil" />

                                        <x-wire-mini-button red 
                                            wire:click="removeDetail({{ $key }})"
                                            spinner="removeDetail({{ $key }})"
                                            icon="trash" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="flex justify-center mt-8">

                    <button class="w-80" x-on:click="$openModal('simpleModal')">

                        <i class="fa-solid fa-inbox text-6xl text-gray-400"></i>

                        <div class="border border-dashed border-gray-400 p-2 mt-4 flex justify-center items-center">

                            <span class="pt-0.5">
                                <i class="fa-solid fa-plus"></i>
                            </span>

                            <span class="ml-2">
                                Agregar un item
                            </span>
                        </div>

                    </button>

                </div>
            @endif
        </div>

        {{-- Totales --}}
        <div class="flex flex-col items-end space-y-4 mt-4">

            @if ($note->mtoOperGravadas)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Ope. Gravada
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoOperGravadas, 2)}}" />
                </div>
            @endif

            @if ($note->mtoOperExoneradas)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Ope. Exonerada
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoOperExoneradas, 2)}}" />
                </div>
            @endif

            @if ($note->mtoOperInafectas)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Ope. Inafecta
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoOperInafectas, 2)}}" />
                </div>
            @endif

            @if ($note->mtoOperGratuitas)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Ope. Gratuita
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoOperGratuitas, 2)}}" />
                </div>
            @endif

            @if ($note->mtoOperExportacion)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Exportacion
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoOperExportacion, 2)}}" />
                </div>
            @endif

            @if ($note->mtoIGVGratuitas)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        IGV Gratuito
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoIGVGratuitas, 2)}}" />
                </div>
            @endif

            <div class="flex items-center space-x-2">
                <span class="whitespace-nowrap">
                    IGV
                </span>

                <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoIGV, 2)}}" />
            </div>
            
            @if ($note->mtoIvap)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        IVAP
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoIvap, 2)}}" />
                </div>
            @endif

            @if ($note->icbper)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        ICBPER
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->icbper, 2)}}" />
                </div>
            @endif

            @if ($note->mtoISC)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        ISC
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoISC, 2)}}" />
                </div>
            @endif

            @if ($note->redondeo)
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap">
                        Redondeo
                    </span>

                    <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->redondeo, 2)}}" />
                </div>
            @endif

            <div class="flex items-center space-x-2">
                <span class="whitespace-nowrap">
                    Importe Total
                </span>

                <x-input disabled class="w-36 text-sm text-right" value="{{number_format($note->mtoImpVenta, 2)}}" />
            </div>

        </div>

        {{-- Leyendas --}}
        <div class="space-y-2 mt-4">
            @forelse ($note->legends as $legend)
                <div class="border border-gray-300 rounded overflow-hidden text-sm xl:flex">

                    @if ($legend['code'] == '1000')
                        <div class="p-2 bg-white border-b xl:border-b-0 xl:border-r border-gray-300">
                            <span class="font-bold">
                                IMPORTE EN LETRAS
                            </span>
                        </div>
                    @endif

                    <div class="p-2 flex-1 uppercase">
                        {{ $legend['value'] }}
                    </div>
                </div>
            @empty
                
                <div class="border border-gray-300 rounded overflow-hidden text-sm xl:flex">
                    <div class="p-2 bg-white border-b xl:border-b-0 xl:border-r border-gray-300">
                        <span class="font-bold">
                            IMPORTE EN LETRAS
                        </span>
                    </div>

                    <div class="p-2 flex-1 uppercase">
                        CERO CON 00/100 SOLES
                    </div>
                </div>

            @endforelse
        </div>

        <div class="flex justify-end mt-4">
            <x-wire-button wire:click="save" spinner="save">
                EMITIR NOTA
            </x-wire-button>
        </div>
    </x-wire-card>

    @include('products.itemDetail')
</div>
