


@extends("auth.index")


@section("ingreso")
<div class="recovery-container" style="height:65%">

    <form class="d-flex flex-row">
        @csrf 
        

        <div class="form-group" style="margin:5px;">
            <label >Correo electrónico</label>
            <input value="gerardo0@gmail.com" type="email" name="correo" id="correo" class="form-control" placeholder="18170256@itculiacan.edu.mx">
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input  class="form-control" value="12345" name="nip" id="nip" placeholder="****">
        </div>

      </div>

      <div class="d-flex flex-row justify-content-center">

            <button id="recuperar" class="btn btn-outline-primary recuperarbtn">Recuperar</button>

      </div>



 <div class="d-flex flex-column justify-content-start login-container  ">


        <div class="d-flex flex-row" style="margin:16px 0px 0px 7px; ">
            <div id="usuario_container">
                <p>Nombre</p>
                <p style="font-size: 13px;"></p> 
            </div>
            <div id="nip_especial_container" class="form-group" style="margin-left: auto">
                <label>NIP ESPECIAL</label>
                <input type="text" value="" class="form-control" name="nip_especial" id="nip_especial" placeholder="****">
            </div> 
          
        </div> 
        





    <div class="d-flex flex-row" style="margin-top: auto">
        <button id="limpiar1" class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button id="ingresar" name="action" value="login" class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>
  </form >


  </div>


@stop



       
  
