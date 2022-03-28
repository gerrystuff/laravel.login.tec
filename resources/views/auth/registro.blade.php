@extends("auth.index")


@section("registro")
<div class="recovery-container" >

    <form id="registro-form" class="d-flex flex-column">

        <div class="d-flex flex-row">
            <label style="margin-left: 5px;">Nombre</label>
        </div>

        <div class="d-flex flex-row justify-content-center">
                <input style="width:98%;" value="Gerardo Padilla" type="text" name="nombre" id="nombre" class="form-control">    
        </div>

        <div class="d-flex flex-row">
            <div class="form-group" style="margin:5px;">
                <label >Correo electrónico</label>
                <input value="gerardo@gmail.com" type="email" name="correo" id="correo" class="form-control" placeholder="18170256@itculiacan.edu.mx">
            </div>
    
            <div class="form-group">
                <label>NIP</label>
                <input value="12345" type="text" class="form-control" name="nip" id="nip" placeholder="****">
            </div>
    
        </div>

        <div class="d-flex flex-row" >
            <div class="form-group" style="width:55%;">
                <label>Tipo usuario</label>
                <select name="tipo" id="tipo" class="form-control" >
                  <option value="1">Especial</option>
                  <option value="2" selected>Regular</option>
                  <option value="3">Espectador</option>
                </select>
              </div>
            
            <div class="form-group">
                <label>NIP Especial</label>
                <input class="form-control" 
                      style="width:100%;" value="" name="nip_especial" id="nip_especial">
            </div>
    
        </div>
        
       



    <div class="d-flex flex-row">
        <button id="limpiar2" class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button id="registrar" class="btn btn-outline-secondary custom-btn">Crear</button>

    </div>

</form>


</div>


@stop
