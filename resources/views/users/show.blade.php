<x-dashboard-layout title="Usuarios | {{ session('company')->nombreComercial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'url' => route('dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

</x-dashboard-layout>