@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Editar Cliente') }}
                    </h2>
                </div>
            </div>
            @include('partials._breadcrumbs', ['model' => $customer])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <form action="{{ route('customers.update', $customer->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Imagen de Perfil') }}
                                    </h3>

                                    <img class="img-account-profile mb-2"
                                        src="{{ $customer->photo ? asset('storage/' . $customer->photo) : asset('assets/img/demo/user-placeholder.svg') }}"
                                        alt="" id="image-preview" />

                                    <div class="small font-italic text-muted mb-2">JPG o PNG no mayor a 2 MB</div>

                                    <input class="form-control @error('photo') is-invalid @enderror" type="file"
                                        id="image" name="photo" accept="image/*" onchange="previewImage();">

                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Editar Cliente') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" label="Nombre" :value="old('name', $customer->name)" :required="true" />

                                            <x-input label="Email" name="email" :value="old('email', $customer->email)" :required="true" />
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Teléfono" name="phone" :value="old('phone', $customer->phone)" :required="true" />
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <label for="bank_name" class="form-label">
                                                {{ __('Nombre del Banco') }}
                                            </label>

                                            <select class="form-select @error('bank_name') is-invalid @enderror"
                                                id="bank_name" name="bank_name">
                                                <option selected="" disabled="">Seleccione el Banco:</option>
                                                <option value="Pichincha"
                                                    @if (old('bank_name', $customer->bank_name) == 'Pichincha') selected="selected" @endif>Pichincha
                                                </option>
                                                <option value="Guayaquil"
                                                    @if (old('bank_name', $customer->bank_name) == 'Guayaquil') selected="selected" @endif>Guayaquil
                                                </option>
                                                <option value="Bolivariano"
                                                    @if (old('bank_name', $customer->bank_name) == 'Bolivariano') selected="selected" @endif>Bolivariano
                                                </option>
                                                <option value="Produbanco"
                                                    @if (old('bank_name', $customer->bank_name) == 'Produbanco') selected="selected" @endif>Produbanco
                                                </option>
                                                <option value="Pacifico"
                                                    @if (old('bank_name', $customer->bank_name) == 'Pacifico') selected="selected" @endif>Pacifico
                                                </option>
                                                <option value="BanEcuador"
                                                    @if (old('bank_name', $customer->bank_name) == 'BanEcuador') selected="selected" @endif>BanEcuador
                                                </option>
                                            </select>

                                            @error('bank_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Titular de la cuenta" name="account_holder" :value="old('account_holder', $customer->account_holder)"
                                                :required="true" />
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Número de cuenta" name="account_number" :value="old('account_number', $customer->account_number)"
                                                :required="true" />
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label required">
                                                    {{ __('Dirección') }}
                                                </label>

                                                <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer->address) }}</textarea>

                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Guardar') }}
                                    </button>

                                    <a class="btn btn-outline-warning" href="{{ route('customers.index') }}">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
