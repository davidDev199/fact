<div x-data="data">

    <form @submit.prevent="save">

        <x-wire-modal-card title="PRODUCTO" name="simpleModal" width="2xl">

            {{-- Si hay errores, se mostrarán aquí --}}
            <div x-show="errors.length" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">¡Ups! Algo salió mal.</strong>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    <template x-for="error in errors" :key="error">
                        <li x-text="error"></li>
                    </template>
                </ul>
            </div>

            <div class="mb-4">
                <x-label>
                    AFECTACION IGV
                </x-label>

                <x-select x-model="tipAfeIgv" class="w-full text-xs">
                    <template x-for="affectation in affectations" :key="affectation.id">
                        <option x-text="affectation.description" :value="affectation.id"></option>
                    </template>
                </x-select>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                {{-- Unidad --}}
                <div>
                    <x-label>
                        UNIDAD
                    </x-label>

                    <x-select x-model="unidad" class="w-full text-xs">
                        @foreach ($units as $unit)
                            <option value="{{ $unit['id'] }}">
                                {{ $unit['description'] }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                                
                {{-- Codigo --}}
                <div>
                    <x-label>
                        CÓDIGO
                    </x-label>

                    <x-input x-model="codProducto" class="w-full text-xs" />
                </div>

                {{-- Codigo de barras --}}
                <div>
                    <x-label>
                        CÓDIGO BARRAS
                    </x-label>

                    <x-input x-model="codBarras" class="w-full text-xs" />
                </div>
            </div>

            {{-- Descripción --}}
            <div class="mb-4">
                <x-label>
                    DESCRIPCIÓN
                </x-label>

                <x-input x-model="descripcion" class="w-full text-xs" />
            </div>

            <div class="flex flex-col items-end space-y-4">
                {{-- Valor unitario --}}
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap text-sm">
                        Valor Unitario
                    </span>

                    <x-input x-model="mtoValor" type="number" step="0.01" class="w-48 text-xs" />
                </div>

                {{-- IGV --}}
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap text-sm">
                        IGV
                    </span>

                    <x-select x-model="porcentajeIgv" class="w-48 text-xs">

                        <option value="0" x-bind:class="tipAfeIgv <= 17 ? 'hidden' : ''">
                            IGV 0%
                        </option>

                        <option value="4" x-bind:class="tipAfeIgv != 17 ? 'hidden' : ''">
                            IGV 4%
                        </option>

                        <option value="10" x-bind:class="tipAfeIgv >= 17 ? 'hidden' : ''">
                            IGV 10%
                        </option>

                        <option value="18" x-bind:class="tipAfeIgv >= 17 ? 'hidden' : ''">
                            IGV 18%
                        </option>

                    </x-select>
                </div>

                {{-- ISC --}}
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap text-sm">
                        ISC
                    </span>

                    <x-select x-model="tipSisIsc" class="w-48 text-xs">
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

                {{-- Porcentaje Isc --}}
                <template x-if="tipSisIsc">
                    <div class="flex items-center space-x-2">
                        <span class="whitespace-nowrap text-sm">
                            Porcentaje Isc
                        </span>

                        <x-input x-model="porcentajeIsc" type="number" class="w-48 text-xs" />
                    </div>
                </template>

                {{-- ICBPER --}}
                <div class="flex items-center space-x-2">
                    <span class="whitespace-nowrap text-sm">
                        ICBPER
                    </span>

                    <x-select x-model="icbper" class="w-48 text-xs">
                        <option value="0">
                            No
                        </option>

                        <option value="1">
                            Si
                        </option>

                    </x-select>
                    
                </div>

                {{-- Factor Icbper --}}
                <template x-if="icbper == 1">
                    <div class="flex items-center space-x-2">
                        <span class="whitespace-nowrap text-sm">
                            Factor Icbper
                        </span>
    
                        <x-input x-model="factorIcbper" step="0.01" type="number" class="w-48 text-xs" />
                        
                    </div>
                </template>
            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-wire-button flat label="Cancel" x-on:click="close" />

                <x-wire-button type="submit" primary label="Guardar" />
            </x-slot>

        </x-wire-modal-card>
    </form>

</div>

@push('js')
    <script>
        function data() {
            return {
                errors: [],

                codProducto: '',
                codBarras: '',
                unidad: 'NIU',
                mtoValor: 0,

                tipAfeIgv: 10,
                porcentajeIgv: 18,

                tipSisIsc: '',
                porcentajeIsc: 0,

                icbper: 0,
                factorIcbper: 0.20,

                descripcion: '',

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
                            this.porcentajeIgv = affectation.id == 17 ? 4 : 18;
                        } else {
                            this.porcentajeIgv = 0;
                        }
                    });
                }
            }
        }
    </script>
@endpush