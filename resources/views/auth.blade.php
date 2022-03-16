<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<style>
    .main-content{
        width: 100vw;
        background-color:rgb(224, 214, 214);
        height: 100vh;
    }

    .log-form{
        width: 500px;
        height: 360px;
        background-color: rgba(255, 255, 255, 0.849);
        border-radius: 35px;
        box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.5);
        padding: 40px 40px 20px 40px;
    }


.form-group{
    margin: 5px;
}
   



    .recuperarbtn{
        width:98%;
    }

    .recovery-container{
        height: 65%;

    }

    .login-container{
        height: 100%;
    }
    .custom-btn{
        width:100%;
        margin:5px;
        color: white;
        /* background-color: grey; */
    }

    .fadegroup {
        height: 70%;
        opacity: 0;
    transition: opacity 5s;
    }
}

</style>
<body>

<div class="main-content d-flex justify-content-center align-items-center">

    <div class="log-form d-flex flex-column">

     <div class="recovery-container">

        <form method="post"  class="d-flex flex-row">
            <div class="form-group">
                <label >Correo electrónico</label>
                <input type="email" class="form-control" placeholder="18170256@itculiacan.edu.mx">
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input type="email" class="form-control" placeholder="****">
            </div>

          </div>

          <div class="d-flex flex-row justify-content-center">

                <button type="submit" class="btn btn-success recuperarbtn">Recuperar</button>

          </div>
        </form >



     <div class="login-container d-flex justify-content-end flex-column">

        <div class="form-group fadegroup" onload="document.body.style.opacity='1'"> 
            <p>Nombre</p>
            <p>Juanito Diaz</p>

        </div>


        <div class="d-flex flex-row">
            <button disabled  class="btn btn-primary custom-btn">Limpiar</button>
            <button type="submit" class="btn btn-primary custom-btn">Ingresar</button>

        </div>


      </div>

    </div>
   </div>
    
</body>
</html>