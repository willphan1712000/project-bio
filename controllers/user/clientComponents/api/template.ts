import apiClient, { Response } from "../../../client/api/apiClient";
import { Template, Template_Info } from "../../../client/types/Template";
import { User_Info } from "../../../client/types/User";
import getUsername, { getParams } from "../../../client/utilities/getUsername";

type Template_User = {
    template: Template,
    template_info: Template_Info,
    template_server_url: string,
    user_info: User_Info
}

/**
 * This function will get template and template info related to the user get from the route
 */
async function getTemplate() {
    const username = getUsername();
    const template_id = getParams("themeid")

    const res = await apiClient.post('/api/template', {
        username,
        template_id
    })

    if(!res.ok) throw new Error(res.problem)

    const data = res.data as Response<Template_User>

    if(!data.success) throw new Error(data.error)

    return data.data
}

export default {
    getTemplate
}