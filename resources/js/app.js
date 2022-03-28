const actualUrl = window.location.pathname;
import { default as Main } from './main';



switch (actualUrl) {
    case "/auth/registro":
        Main.registroView();
        break;
    case "/auth/ingreso":
        Main.ingresoView();

}