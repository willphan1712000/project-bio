import apiClient, { Response } from "../../../client/api/apiClient";
import { Template, Template_Info } from "../../../client/types/Template";
import { Raw_Info, User_Info, User_Resources, User_Style } from "../../../client/types/User";
import getUsername, { getParams } from "../../../client/utilities/getUsername";
import errorFormat from "../../utilities/errorFormat";

export type Template_User = {
    template: Template,
    template_info: Template_Info,
    template_server_url: string,
    raw_info: Raw_Info,
    user_info: User_Info,
    user_style: User_Style,
    user_resources: User_Resources
}

/**
 * This function will get template and template info related to the user get from the route
 * @returns promise - Promise of Template_User
 */
async function getTemplate() {
    const username = getUsername();
    const template_id = getParams("themeid")

    const res = await apiClient.post('/api/template', {
        username,
        template_id
    })

    const data = res.data as Response<Template_User>

    if(!res.ok) {
        throw new Error(errorFormat(
            res.problem,
            data.error
        ))
    }

    return data.data
}

/**
 * Handle update user template information and user information
 */
async function updateTemplate(userData: any) {
    const res = await apiClient.put("/api/template", userData)

    if(!res.ok) {
        throw new Error(res.problem)
    }

    const data = res.data as Response<any>;
    if(!data.success) {
        throw new Error(data.error)
    }

    return data.data
}

export default {
    getTemplate,
    updateTemplate
}