@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if(!$purchases)
    <x-empty
        title="No se encontraron compras"
        message="Intente ajustar su búsqueda o filtro para encontrar lo que está buscando."
        button_label="{{ __('Agrega tu primera compra') }}"
        button_route="{{ route('purchases.create') }}"
    />
    @else
    <div class="container-xl">
        @livewire('tables.purchase-table')
    @endif
</div>
@endsection
