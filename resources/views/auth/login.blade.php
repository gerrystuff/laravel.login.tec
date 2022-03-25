@extends("auth.index")

@section("login")
<div class="recovery-container" style="height:65%">

    <form method="post" action="{{ url('/auth/login') }}"  class="d-flex flex-row">
        @csrf 
        

        <div class="form-group" style="margin:5px;">
            <label >Correo electrónico</label>
            <input value="gerardo@gmail.com" type="email" name="correo" id="correo" class="form-control" placeholder="18170256@itculiacan.edu.mx">
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" value="12345" class="form-control" name="nip" id="nip" placeholder="****">
        </div>

      </div>

      <div class="d-flex flex-row justify-content-center">

            <button type="submit" name="action" value="recovery" class="btn btn-outline-primary recuperarbtn">Recuperar</button>

      </div>



 <div class="d-flex flex-column justify-content-start login-container  ">


    @if ($res = Session::get('usuarioRecuperado'))
      @if(!$res["error"])
        <div class="d-flex flex-row" style="margin:16px 0px 0px 7px; ">
          <div>
            <p>Nombre</p>
            <p style="font-size: 13px;">{{$res["payload"]->nombre}}</p> 
          </div>
          
        @if($res["payload"]->nip_especial != "")
          <div class="form-group" style="margin-left: auto">
            <label>NIP ESPECIAL</label>
            <input type="text" value="" class="form-control" name="nip_especial" id="nip_especial" placeholder="****">
          </div>
          @endif 
        </div> 
        
      @endif
    @endif





    <div class="d-flex flex-row" style="margin-top: auto">
        <button disabled  class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button type="submit" name="action" value="login" class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>
  </form >


  </div>


@stop

       
  
