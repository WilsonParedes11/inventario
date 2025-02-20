@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear unidad') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('units.index') }}" />
                </div>
            </div>

            <form action="{{ route('units.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <livewire:name />

                    <x-input
                        label="{{ __('Código corto') }}"
                        id="short_code"
                        name="short_code"
                        :value="old('short_code')"
                        required
                    />
                </div>
                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Crear') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
