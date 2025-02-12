@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$customers)
            <x-empty title="No se encontraron clientes"
                message="Intente ajustar su búsqueda o filtro para encontrar lo que está buscando."
                button_label="{{ __('Agregue su primer cliente') }}" button_route="{{ route('customers.create') }}" />
        @else
            <div class="container-xl">

                {{-- -
            <div class="card">
                <div class="card-body">
                    <livewire:power-grid.customers-table/>
                </div>
            </div>
            - --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Transacción Realizada con exito</h3>
                        <p>{{ session('success') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                @livewire('tables.customer-table')
            </div>
        @endif
    </div>
@endsection
