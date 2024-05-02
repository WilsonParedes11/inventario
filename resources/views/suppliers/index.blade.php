@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if(!$suppliers)
        <x-empty
            title="No existen proveedores"
            message="Intente ajustar su búsqueda o filtro para encontrar lo que está buscando."
            button_label="{{ __('Agregue su primer proveedor') }}"
            button_route="{{ route('suppliers.create') }}"
        />
    @else
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <h3 class="mb-1">Correcto</h3>
                    <p>{{ session('success') }}</p>

                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @livewire('tables.supplier-table')
        </div>
    @endif
</div>
@endsection
