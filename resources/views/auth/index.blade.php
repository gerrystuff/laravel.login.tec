@extends('auth.layout')

@section('content')
<div class="main-content d-flex justify-content-center align-items-center">
    <div class="log-form d-flex flex-column align-items-center">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/auth/login">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/auth/register">Registro</a>
        </li>

      </ul>

    @yield('login')
    @yield('register')
    </div>
</div>