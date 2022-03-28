


@extends("auth.index")


<?php 
$var = "eo";
?>

@section("ingreso")
<div class="recovery-container" style="height:65%">

    <form class="d-flex flex-row">
        @csrf 
        

        <div class="form-group" style="margin:5px;">
            <label >Correo electrónico</label>
            <input value="gerardo@gmail.com" type="email" name="correo" id="correo" class="form-control" placeholder="18170256@itculiacan.edu.mx">
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input  class="form-control" name="nip" id="nip" placeholder="****">
        </div>

      </div>

      <div class="d-flex flex-row justify-content-center">

            <button id="recuperar" class="btn btn-outline-primary recuperarbtn">Recuperar</button>

      </div>



 <div class="d-flex flex-column justify-content-start login-container  ">


        <div class="d-flex flex-row" id="datos-recuperados" style="margin:16px 0px 0px 7px; ">
         
          
        </div> 
        





    <div class="d-flex flex-row" style="margin-top: auto">
        <button id="limpiar1" class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button id="ingresar" name="action" value="login" class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>
  </form >


  </div>


@stop



       
  
