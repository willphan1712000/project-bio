import { $$ } from "../client/src/Web-Development/W";
import App from "./clientComponents/App";

$(document).ready(function() {
    const container = document.getElementById("container_template");
    if(!container) return

    $$("#container_template", <App />).reactMounting()
})