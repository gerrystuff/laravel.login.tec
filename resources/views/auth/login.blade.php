@extends("auth.index")

@section("login")
<div class="recovery-container" style="height:65%">

    <form method="post" action="{{ url('/auth/login') }}"  class="d-flex flex-row">
        @csrf 
        

        <div class="form-group" style="margin:5px;">
            <label >Correo electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="18170256@itculiacan.edu.mx">
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="****">
        </div>

      </div>

      <div class="d-flex flex-row justify-content-center">

            <button type="submit" class="btn btn-outline-primary recuperarbtn">Recuperar</button>

      </div>
    </form >



 <div class="login-container d-flex justify-content-end flex-column">

    <div class="form-group fadegroup" onload="document.body.style.opacity='1'"> 
        <p>Nombre</p>
        <p>Juanito Diaz</p>

    </div>


    <div class="d-flex flex-row">
        <button disabled  class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button type="submit" class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>

    <div class="d-flex flex-row">
        @if ($message = Session::get('res'))
        <div class="alert alert-success">
            <p>{{ json_encode($message) }}</p>
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </div>


  </div>


@stop

       
  
