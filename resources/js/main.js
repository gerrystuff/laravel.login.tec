import axios from "axios";

class Main {


    constructor() {

        //Aux
        this.requestStatus = null;

        //Defaults
        this.mainContainer = document.getElementById("main-content");
        this.correoInput = document.getElementById("correo");
        this.nipInput = document.getElementById("nip");

        //Login targets
        this.nipEspecialContainer;
        this.usuarioContainer;

        this.nipEspecialInput;
        this.recuperarBtn;
        this.ingresarBtn;
        this.limpiarBtn1;

        //Store targets
        this.registrarBtn;
        this.nombreInput;
        this.tipoUsuarioInput;
        this.registrarBtn;
        this.limpiarBtn2;


        //Forms
        this.registroForm;
        this.recuperarForm;
    }


    _requestInfoTemplate(data) {

        const template = document.createElement('div');

        template.innerHTML = `
        <div class="alert ${data.error ? 'alert-danger' : 'alert-success'}">
            <p>${data.msg}</p>
        </div>`

        return template;
    }

    _validationFormsTemplate() {

        const template = document.createElement('div');

        template.innerHTML = `
        <div class="alert alert-warning mt-5">
            <p>Ingrese todos los campos</p>
        </div>`

        return template;
    }

    _validRecuperar() {
        let state = true;
        if (this.correoInput.value == "" || this.nipInput.value == '')
            state = false;

        return state;
    }




    _appendAlert(data) {

        if (this.requestStatus != null)
            this.mainContainer.removeChild(this.requestStatus);


        this.requestStatus = this._requestInfoTemplate(data);

        this.mainContainer.insertBefore(this.requestStatus, this.mainContainer.firstChild);

    }

    _setIngresoTargets() {
        this.recuperarBtn = document.getElementById("recuperar");
        this.ingresarBtn = document.getElementById("ingresar");
        this.limpiarBtn1 = document.getElementById("limpiar1")
        this.usuarioContainer = document.getElementById("usuario_container");
        this.nipEspecialContainer = document.getElementById("nip_especial_container");
        this.nipEspecialInput = document.getElementById("nip_especial");
    }

    _setRegistroTargets() {
        this.limpiarBtn2 = document.getElementById("limpiar2");
        this.registrarBtn = document.getElementById("registrar");
        this.registroForm = document.getElementById("registro-form");
        this.tipoUsuarioInput = document.getElementById("tipo");
        this.nipEspecialInput = document.getElementById("nip_especial");
    }

    _setIngresoListeners() {

        this.recuperarBtn.addEventListener('click', (event) => {
            event.preventDefault();

            this.usuarioContainer.style.display = "none";
            this.nipEspecialContainer.style.display = "none";

            const validRec = this._validRecuperar();

            if (!validRec) {
                this._appendAlert({ error: true, msg: "Ingrese todos los campos" })
                return;
            }


            axios.post('/auth/recuperar', {
                correo: this.correoInput.value,
                nip: this.nipInput.value
            }).then((res) => {

                const { data } = res;
                console.log(data);

                if (!data.error) {
                    this._appendAlert(data);

                    this.usuarioContainer.style.display = "block";
                    this.usuarioContainer.lastElementChild.innerHTML = data.usuario.nombre;

                    if (data.usuario.tipo == 1)
                        this.nipEspecialContainer.style.display = "block";
                    else
                        this.nipEspecialContainer.style.display = "none";
                }

                this._appendAlert(data);

            }).catch((err) => {
                console.log(err)
            })

        })

        this.ingresarBtn.addEventListener('click', (event) => {
            event.preventDefault();



            axios.post('login', {
                correo: this.correoInput.value,
                nip: this.nipInput.value,
                nip_especial: this.nipEspecialInput.value

            }).then((res) => {
                const { data } = res;
                console.log(data)

                if (data.error) {
                    this._appendAlert(data);
                    return;
                }

                window.location = "/home";

            }).catch((err) => {
                console.log(err)
            })

        })

        this.limpiarBtn1.addEventListener('click', (event) => {
            event.preventDefault();

            this.correoInput.value = '';
            this.nipInput.value = '';
            this.nipEspecialInput.value = '';

        })
    }

    _setRegistroListeners() {
        this.registrarBtn.addEventListener('click', (event) => {
            event.preventDefault();


            //Parse inputs to usuario json
            var usuario = {};
            usuario["nip_especial"] = "";
            var formData = new FormData(this.registroForm);
            formData.forEach((value, key) => {
                usuario[key] = value;
            })

            if (usuario)


                axios.post('registro', usuario).then((res) => {

                const { data } = res;

                console.log(JSON.stringify(data));

                this._appendAlert(data);

            }).catch((err) => {
                console.log(err)
            })

        })

        this.limpiarBtn2.addEventListener('click', (event) => {
            event.preventDefault();

            document.getElementById("nombre").value = "";
            document.getElementById("correo").value = "";
            document.getElementById("nip").value = "";
            document.getElementById("nip").value = "";


            console.log("limpiar 2")
        })

        this.tipoUsuarioInput.addEventListener('change', (event) => {
            event.preventDefault();

            if (this.tipoUsuarioInput.value == 1)
                this.nipEspecialInput.disabled = false;

            else {
                this.nipEspecialInput.value = "";
                this.nipEspecialInput.disabled = true;

            }
        })
    }



    ingresoView() {

        //Targets
        this._setIngresoTargets();

        //Config
        this.usuarioContainer.style.display = "none";
        this.nipEspecialContainer.style.display = "none";

        //Listeners        
        this._setIngresoListeners();

    }



    registroView() {

        //Targets
        this._setRegistroTargets();

        //Config 
        this.nipEspecialInput.disabled = true;

        //Listeners
        this._setRegistroListeners();
    }
}

const main = new Main();

export default main;