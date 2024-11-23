<div x-data="dataProduct">

    <form wire:submit="addDetail">

        <x-wire-modal-card 
            title="PRODUCTO"
            name="simpleModal"
            wire:model.live="openModal"
            width="2xl">

            <x-wire-errors :only="[
                'product.cantidad',
                'product.unidad',
                'product.descripcion',
                'product.codProducto',
            ]" class="mb-4" />

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <x-label>
                        CANTIDAD
                    </x-label>
                    <x-input x-model="product.cantidad" class="w-full text-xs" />
                </div>
                
                <div>
                    <x-label>
                        UNIDAD
                    </x-label>

                    <x-select x-model="product.unidad" class="w-full text-xs">
                        @foreach ($units as $unit)
                            <option value="{{ $unit['id'] }}">
                                {{ $unit['description'] }}
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <div>
                    <x-label>
                        CÓDIGO
                    </x-label>

                    <x-input x-model="product.codProducto" class="w-full text-xs" />
                </div>
            </div>

            <div class="mb-4">
                <x-label>
                    DESCRIPCIÓN
                </x-label>

                <x-input x-model="product.descripcion" class="w-full text-xs" />
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
        function dataProduct() {
            return {
                product: @entangle('product'),
            }
        }
    </script>
@endpush