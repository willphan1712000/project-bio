import auth from "../client/auth/auth";
import { $$ } from "../client/src/Web-Development/W";
import App from "./clientComponents/App";
import "@radix-ui/themes/styles.css";

$(document).ready(async function() {
    const isSignedIn = await auth.validate()

    if(isSignedIn)
        $$("#admin_container", <App />).reactMounting()
})