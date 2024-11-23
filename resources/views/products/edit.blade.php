<div x-data="dataUpdate">

    <form wire:submit="update">

        <x-wire-modal-card 
            title="PRODUCTO"
            wire:model="productEdit.open"
            width="3xl">

            <x-validation-errors class="mb-6" />

            <div class="grid grid-cols-2 gap-4">

                {{-- Codigo producto --}}
                <div class="col-span-1">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                CÓDIGO PRODUCTO
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-input x-model="productEdit.codProducto" class="w-full text-xs" />
                        </div>
                    </div>
                </div>

                {{-- Codigo barras --}}
                <div class="col-span-1 gap-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                CÓDIGO BARRAS
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-input x-model="productEdit.codBarras" class="w-full text-xs" />
                        </div>
                    </div>
                </div>

                {{-- Unidad de medida --}}
                <div class="col-span-1 gap-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                UNIDAD MEDIDA
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-select x-model="productEdit.unidad" class="w-full text-xs">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit['id'] }}">
                                        {{ $unit['description'] }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>

                {{-- Precio --}}
                <div class="col-span-1 gap-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2 uppercase">
                                Precio (Sin IGV)
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-input x-model="productEdit.mtoValor" type="number" class="w-full text-xs" />
                        </div>
                    </div>
                </div>

                {{-- Tipo de afectacion --}}
                <div class="col-span-1 gap-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                AFECTACION IGV
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-select x-model="productEdit.tipAfeIgv" class="w-full text-xs">
                                <template x-for="affectation in affectations" :key="affectation.id">
                                    <option x-text="affectation.description" :value="affectation.id"></option>
                                </template>
                            </x-select>
                        </div>
                    </div>
                </div>

                {{-- IGV --}}
                <div class="col-span-1 gap-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                IGV
                            </span>
                        </div>
                        <div class="col-span-3">
                            <x-select x-model="productEdit.porcentajeIgv" class="w-full text-xs">

                                <option value="0" x-bind:class="tipAfeIgv <= 17 ? 'hidden' : ''">
                                    IGV 0%
                                </option>

                                <option value="10" x-bind:class="tipAfeIgv >= 20 ? 'hidden' : ''">
                                    IGV 10%
                                </option>

                                <option value="18" x-bind:class="tipAfeIgv >= 20 ? 'hidden' : ''">
                                    IGV 18%
                                </option>

                            </x-select>
                        </div>
                    </div>
                </div>

                {{-- ISC --}}
                <div class="col-span-1">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                ISC
                            </span>
                        </div>
                        <div class="col-span-3">

                            <x-select x-model="productEdit.tipSisIsc" class="w-full text-xs">
                                <option value="">
                                    Ninguno
                                </option>

                                <option value="01">
                                    Sistema al valor
                                </option>

                                <option value="02">
                                    Monto Fijo
                                </option>

                                <option value="03">
                                    Precios Público
                                </option>

                            </x-select>

                        </div>
                    </div>
                </div>

                {{-- Porcentaje Isc --}}
                <template x-if="tipSisIsc">
                    <div class="col-span-1">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-2">
                                <span class="text-xs inline-block uppercase mt-2">
                                    Porcentaje Isc
                                </span>
                            </div>
                            <div class="col-span-3">
                                <x-input x-model="productEdit.porcentajeIsc" type="number" class="w-full text-xs" />
                            </div>
                        </div>
                    </div>
                </template>

                {{-- ICBPER --}}
                <div class="col-span-1">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block mt-2">
                                ICBPER
                            </span>
                        </div>
                        <div class="col-span-3">

                            <x-select x-model="productEdit.icbper" class="w-full text-xs">
                                <option value="0">
                                    No
                                </option>

                                <option value="1">
                                    Si
                                </option>

                            </x-select>

                        </div>
                    </div>
                </div>

                {{-- Factor ICBPER --}}
                <template x-if="icbper == 1">
                    <div class="col-span-1">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-2">
                                <span class="text-xs inline-block uppercase mt-2">
                                    Factor Icbper
                                </span>
                            </div>
                            <div class="col-span-3">
                                <x-input x-model="productEdit.factorIcbper" step="0.01" type="number" class="w-full text-xs" />
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Descripción --}}
                <div class="col-span-2">
                    <div class="grid grid-cols-10 gap-4">
                        <div class="col-span-2">
                            <span class="text-xs inline-block uppercase mt-2">
                                Descripción
                            </span>
                        </div>
                        <div class="col-span-8">
                            <x-input x-model="productEdit.descripcion" class="w-full text-xs" />
                        </div>
                    </div>
                </div>
            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-wire-button flat label="Cancel" x-on:click="close" />

                <x-wire-button type="submit" primary label="Actualizar" />
            </x-slot>

        </x-wire-modal-card>
    </form>

</div>

@push('js')
    <script>
        function dataUpdate() {
            return {
                errors: [],

                productEdit: @entangle('productEdit'),

                affectations: @json($affectations),

                save() {

                    axios.post('/products', {
                        codProducto: this.codProducto,
                        codBarras: this.codBarras,
                        unidad: this.unidad,
                        mtoValor: this.mtoValor,
                        tipAfeIgv: this.tipAfeIgv,
                        porcentajeIgv: this.porcentajeIgv,
                        tipSisIsc: this.tipSisIsc,
                        porcentajeIsc: this.porcentajeIsc,
                        icbper: this.icbper,
                        factorIcbper: this.factorIcbper,
                        descripcion: this.descripcion
                    }).then(response => {

                        $closeModal('simpleModal');

                        Livewire.dispatch('productAdded');

                        this.errors = [];

                        //Reset form
                        this.codProducto = '';
                        this.codBarras = '';
                        this.unidad = 'NIU';
                        this.mtoValor = 0;
                        this.tipAfeIgv = 10;
                        this.porcentajeIgv = 18;
                        this.tipSisIsc = '';
                        this.porcentajeIsc = 0;
                        this.icbper = 0;
                        this.factorIcbper = 0.20;
                        this.descripcion = '';
                        
                        //Actualizar tabla
                        this.getCode();

                    }).catch(error => {
                        if (error.response.status === 422) {
                            this.errors = Object.values(error.response.data.errors).flat();
                        }

                        console.log(error.response.data);
                    });
                },

                getCode() {
                    axios.post('/products/code').then(response => {
                        this.codProducto = response.data;
                        this.codBarras = response.data;
                    });
                },

                init() {

                    this.getCode();

                    this.$watch('tipAfeIgv', value => {
                        affectation = this.affectations.find(affectation => affectation.id == value);

                        if (affectation.igv) {
                            this.porcentajeIgv = 18;
                        } else {
                            this.porcentajeIgv = 0;
                        }
                    });
                }
            }
        }

        function confirmDelete(productId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy', productId);
                }
            });
        }
    </script>
@endpush