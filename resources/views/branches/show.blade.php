<x-dashboard-layout title="Sucursales | {{ session('company')->nombreComercial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'url' => route('dashboard'),
    ],
    [
        'name' => 'Sucursales',
    ],
]">

</x-dashboard-layout>