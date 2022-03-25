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



 <div class="d-flex flex-column justify-content-start login-container  ">

    <div class="form-group "> 
        <p  style="margin:0;padding:0;">Nombre</p>
        <small>Juanito Diaz</small>

    </div>


    <div class="d-flex flex-row">
        <button disabled  class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button type="submit" class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>


  </div>


@stop

       
  
