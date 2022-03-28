import axios from "axios";
// var ProgressBar = require('progressbar.js');
// var bar = new ProgressBar.Circle('#container', {
//     strokeWidth: 6,
//     easing: 'easeInOut',
//     duration: 1400,
//     color: '#FFEA82',
//     trailColor: '#eee',
//     trailWidth: 1,
//     svgStyle: null
// });
// bar.animate(1.0);
class Main {


    constructor() {

        //Aux
        this.requestStatus = null;

        //Defaults
        this.mainContainer = document.getElementById("main-content");
        this.correoInput = document.getElementById("correo");
        this.nipInput = document.getElementById("nip");
        this.nipEspecialInput = document.getElementById("nip_especial");

        //Login targets
        this.recuperarBtn;
        this.registrarBtn;
        this.ingresarBtn;
        this.limpiarBtn1;
        this.datosRecuperadosPanel;

        //Store targets
        this.nombreInput;
        this.tipoUsuarioInput;
        this.registrarBtn;
        this.limpiarBtn2;


        //Forms
        this.registroForm;
        this.recuperarForm;


    }


    datosRecuperadosTemplate(nombre, nip_especial) {
            let template = `${
            `
        <div>
            <p>Nombre</p>
            <p style="font-size: 13px;">${nombre}</p> 
        </div>
        
        ` 
        }`
        
        if(nip_especial != ""){
            template += `${
                `
            <div class="form-group" style="margin-left: auto">
                <label>NIP ESPECIAL</label>
                <input type="text" value="" class="form-control" name="nip_especial" id="nip_especial" placeholder="****">
            </div> 
                `
            }`
        }
        
        return template;
    }

    requestInfoTemplate(data){

        const template = document.createElement('div');

        template.innerHTML = `
        <div class="alert ${data.error ? 'alert-danger' : 'alert-success'}">
            <p>${data.msg}</p>
        </div>`

        return template;
    }

    validationFormsTemplate(){

        const template = document.createElement('div');

        template.innerHTML = `
        <div class="alert alert-warning mt-5">
            <p>Ingrese todos los campos</p>
        </div>`

        return template;
    }

    validRecuperar(){
        console.log(this.nipEspecialInput);
        let state = true;
        if(this.correoInput.value == "" || this.nipInput.value == '')
        state = false;

        return state;
    }
    validLogin(){
        let state = true;
        if(this.correoInput.value == "" || this.nipInput.value == '' )
        state = false;


        return state;
    }


    ingresoView() {

        //Targets
        this.recuperarBtn = document.getElementById("recuperar");
        this.ingresarBtn = document.getElementById("ingresar");
        this.limpiarBtn1 = document.getElementById("limpiar1")
        this.datosRecuperadosContainer = document.getElementById("datos-recuperados");

        //Config
        this.ingresarBtn.disabled =  true;




        //Listeners
        this.recuperarBtn.addEventListener('click', (event) => {
            event.preventDefault();



            const validRec = this.validRecuperar();

            if(!validRec){
                this.mainContainer.appendChild(this.validationFormsTemplate());
                return;
            }



           axios.post('recuperar', {
                correo: this.correoInput.value,
                nip: this.nipInput.value

            }).then((res) => {

                const { data } = res;
                if (!data.error) {
                    this.datosRecuperadosContainer.innerHTML = this.datosRecuperadosTemplate(
                        data.payload.nombre,
                        data.payload.nip_especial
                    )
                    this.ingresarBtn.disabled = false;
                }

            }).catch((err) => {
                console.log(err)
            })

        })

        this.ingresarBtn.addEventListener('click', (event) => {
            event.preventDefault();




            axios.post('login', {
                correo: this.correoInput.value,
                nip: this.nipInput.value

            }).then((res) => {

                const { data } = res;
                console.log(data);
                if (!data.error) {
                    this.datosRecuperadosContainer.innerHTML = this.datosRecuperadosTemplate(
                        data.payload.nombre,
                        data.payload.nip_especial
                    )
                }

            }).catch((err) => {
                console.log(err)
            })

        })

        this.limpiarBtn1.addEventListener('click', (event) => {
            event.preventDefault();

            console.log("limpiar 1")
        })


    }

    

    registroView() {
        
        //Target buttons
        this.limpiarBtn2 = document.getElementById("limpiar2");
        this.registrarBtn = document.getElementById("registrar");
        this.registroForm = document.getElementById("registro-form");
        this.tipoUsuarioInput = document.getElementById("tipo");

        //Config targets
        this.nipEspecialInput.disabled = true;

        this.tipoUsuarioInput.addEventListener('change',(event) => {
            event.preventDefault();

            if(this.tipoUsuarioInput.value == 1)
                this.nipEspecialInput.disabled = false;
            
            else{
                this.nipEspecialInput.value = "";
                this.nipEspecialInput.disabled = true;
            
        }
        })
 

        //Listeners
        this.registrarBtn.addEventListener('click', (event) => {
            event.preventDefault();

            
            //Parse inputs to usuario json
            var usuario = {};
            var formData = new FormData(this.registroForm);    
            formData.forEach((value, key) => {
                usuario[key] = value;
            })

  
            axios.post('registro', usuario).then((res) => {

                if(this.requestStatus != null)
                    this.mainContainer.removeChild(this.requestStatus);
                    
                const { data } = res;

                this.requestStatus = this.requestInfoTemplate(data);

                this.mainContainer.insertBefore(this.requestStatus,this.mainContainer.firstChild);
            }).catch((err) => {
                console.log(err)
            })

        })

        this.limpiarBtn2.addEventListener('click', (event) => {
            event.preventDefault();

            console.log("limpiar 2")
        })
    }


    
}

const main = new Main();

export default main;