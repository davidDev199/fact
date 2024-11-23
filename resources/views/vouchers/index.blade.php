<x-dashboard-layout title="Comprobantes | {{ session('company')->nombreComercial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'url' => route('dashboard'),
    ],
    [
        'name' => 'Comprobantes',
    ],
]">
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 mb-8">
        <x-wire-button href="{{route('vouchers.invoice')}}">
            Factura
        </x-wire-button>

        <x-wire-button href="{{route('vouchers.invoice') . '?tipoDoc=03'}}">
            Boleta
        </x-wire-button>

        <x-wire-button href="{{route('vouchers.note')}}">
            Nota de Crédito
        </x-wire-button>

        <x-wire-button href="{{route('vouchers.note') . '?tipoDoc=08'}}">
            Nota de Débito
        </x-wire-button>
    </div>

    <div>
        @livewire('voucher-table')
    </div>

</x-dashboard-layout>