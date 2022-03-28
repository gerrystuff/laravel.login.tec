@extends('auth.layout')

@section('content')

<div id="main-content" class="main-content d-flex flex-column justify-content-center align-items-center">
  <div class="log-form d-flex flex-column align-items-center">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/auth/ingreso">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/auth/registro">Registro</a>
        </li>

      </ul>

    @yield('ingreso')
    @yield('registro')

    </div>
</div>