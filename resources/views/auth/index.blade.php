@extends('auth.layout')

@section('content')
<div class="main-content d-flex flex-column justify-content-center align-items-center">
    @if ($res = Session::get('res'))
      @if($res["error"])
      <div class="alert alert-danger">
        <p>{{ $res["msg"] }}</p>
      </div>
     @else 
    <div class="alert alert-success">
        <p>{{ $res["msg"] }}</p>
    </div>
      @endif
@endif




  <div class="log-form d-flex flex-column align-items-center">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/auth/login">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/auth/register">Registro</a>
        </li>

      </ul>
      <hr/>

    @yield('login')
    @yield('register')
    </div>
</div>