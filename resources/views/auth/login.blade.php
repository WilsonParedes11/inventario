@extends('layouts.auth')

@section('content')
  <div class="d-flex justify-content-center align-items-center vh-100 ">
    <div class="d-flex align-items-center bg-white p-4 rounded bg-danger">
      <div style="margin-right: 20px;">
        <a class="navbar-brand navbar-brand-autodark">
          <img src="{{ asset('static/logo.png') }}" width="110" height="84"
            alt="Tabler" class="navbar-brand-image" style="height: 80%">
        </a>
      </div>
      <div class="card-md" style="width: 600px;">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">
            Ingrese a su cuenta
          </h2>
          <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">
                Dirección de correo electrónico
              </label>
              <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="tu@correo electrónico.com" autocomplete="off"
                value="{{ old('email') }}">

              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">
                Contraseña
              </label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Tu contraseña" autocomplete="off">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="mb-2">
              <label for="remember" class="form-check">
                <input type="checkbox" id="remember" name="remember"
                  class="form-check-input" />
                <span class="form-check-label">Recuérdame en este
                  dispositivo</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">
                Iniciar sesión
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
