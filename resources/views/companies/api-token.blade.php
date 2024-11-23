<x-dashboard-layout
title="Compañías | {{session('company')->nombreComercial}}" 
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'API Token',
    ],
]">

    @livewire('api-token-manager', ['company' => $company])

</x-dashboard-layout>