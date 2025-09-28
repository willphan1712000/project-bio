import apiClient, { Response } from "../../../client/api/apiClient";
import auth from "../../../client/auth/auth";

async function getUserSignin() {
    return await auth.validate()
}

async function deleteUser(username: string) {
    const res = await apiClient.post('/data/api/user/DELETEHOLD.php', {
        username
    })

    if(!res.ok) throw new Error(res.problem)

    const data = res.data as Response<undefined>
    if(!data.success) throw new Error(data.error)

    return data.success
}

export default {
    deleteUser,
    getUserSignin
}