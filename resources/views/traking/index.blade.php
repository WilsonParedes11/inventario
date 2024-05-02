@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$products)
            <x-empty title="No products found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Agregue su primer producto') }}" button_route="{{ route('products.create') }}" />

            <div style="text-center" style="padding-top:-25px">
                <center>
                    <a href="{{ route('products.import.view') }}" class="">
                        {{ __('Import Products') }}
                    </a>
                </center>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.traking-table')
            </div>
        @endif
    </div>
@endsection
