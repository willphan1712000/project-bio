import { username } from "../admin/clientComponentsOld/AdminContext";
import Delete from "../admin/clientComponentsOld/Delete/Delete";
import { fetchData, getResource } from "../admin/clientComponentsOld/FetchData";
import { $$ } from "../client/src/Web-Development/W";
import InfoArea from "./clientComponents/InfoArea";

$(document).ready(function() {
    adminPage()
})

async function adminPage() {
    // Get information from database
    const list = await fetchData()

    // Get needed resource
    const resource = await getResource()

    $$("#info__wrapper", <InfoArea data={list} extraData={{defaultImgPath: resource.defaultImg, regexMap: resource.regexMap, labelMap: resource.labelMap, iconMap: resource.iconMap}}/>).reactMounting() // Mount React components

    $$("#delete", <Delete message={resource.deleteWarning}/>).reactMounting() // Mount React component
}