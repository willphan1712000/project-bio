import apiClient, { Response } from "../../../client/api/apiClient"

type ResourceDataType = {
    deleteWarning: {
        msg1: string,
        msg2: string,
        msg3: string,
        msg4: string
    },
    regexMap: {
        [key: string]: string
    },
    labelMap: {
        [key: string]: string
    },
    defaultImg: string,
    iconMap: {
        [key: string]: string
    }
}

export default async function getResource() {
    const res = await apiClient.get('/api/resources')

    if(!res.ok) throw new Error(res.problem)

    const data = res.data as Response<ResourceDataType>
    if(!data.success) throw new Error(data.error)

    return data.data
}