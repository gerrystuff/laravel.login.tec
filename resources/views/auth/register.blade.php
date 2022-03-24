@extends("auth.index")


@section("register")
<div class="recovery-container" >

    <form method="post"  action="{{ url('auth/register') }}"  class="d-flex flex-column">
        @csrf 
        
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
                <input value="12345" type="text" class="form-control" style="width:100%;" name="nip_especial" id="nip_especial" placeholder="****">
            </div>
    
        </div>
        
       



    <div class="d-flex flex-row">
        <button disabled  class="btn btn-outline-secondary custom-btn">Limpiar</button>
        <button  class="btn btn-outline-secondary custom-btn">Ingresar</button>

    </div>
    <div class="d-flex flex-row">
        @if ($message = Session::get('usuario'))
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
</form>


</div>


@stop
