@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($units->isEmpty())
        <x-empty
            title="No units found"
            message="Intente ajustar su búsqueda o filtro para encontrar lo que está buscando."
            button_label="{{ __('Agregue su primer Unit') }}"
            button_route="{{ route('units.create') }}"
        />
    @else
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <h3 class="mb-1">Transacción Realizada con exito</h3>
                    <p>{{ session('success') }}</p>

                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @livewire('tables.unit-table')
        </div>
    @endif
</div>
@endsection
