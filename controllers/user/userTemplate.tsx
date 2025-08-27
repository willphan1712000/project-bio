import { $$ } from "../client/src/Web-Development/W"
import App from "./clientComponents/App";

$(document).ready(function () {
    userTemplate()
})

function userTemplate() {
    const container = document.getElementById("container") as HTMLElement;
    if(!container) return

    $$("#container", <App />).reactMounting()
}