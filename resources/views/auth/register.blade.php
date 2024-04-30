@extends('layouts.auth')

@section('content')
<form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off">
    @csrf

    <div class="card-body">
        <h2 class="card-title text-center mb-4">Crear una nueva cuenta</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" name="username" id="username"
                   class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}"
                   placeholder="Ingrese su nombre de usuario"
            >

            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Ingrese el nombre completo"
            >

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Dirección de correo electrónico</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="EIngrese correo electrónico"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group input-group-flat">
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Contraseña"
                       autocomplete="off"
                >

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">confirmar Contraseña</label>
            <div class="input-group input-group-flat">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Confirmación de contraseña"
                       autocomplete="off"
                >

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-check">
                <input type="checkbox" name="terms-of-service" id="terms-of-service"
                       class="form-check-input @error('terms-of-service') is-invalid @enderror"
                >
                <span class="form-check-label">
                    aceptar<a href="./terms-of-service.html" tabindex="-1">
                        términos y política de uso</a>.
                </span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                Crear una nueva cuenta
            </button>
        </div>
    </div>
</form>
<div class="text-center text-secondary mt-3">
    ¿Ya tienes cuenta?<a href="{{ route('login') }}" tabindex="-1">
        Iniciar sesión
    </a>
</div>
@endsection
