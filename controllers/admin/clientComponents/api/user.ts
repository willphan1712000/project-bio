import apiClient, { Response } from "../../../client/api/apiClient";

export type UserSignin = {
    status: boolean,
    username: string
} | undefined

async function getUserSignin() {
    const res = await apiClient.get('/api/auth/username')

    if(!res.ok) throw new Error(res.problem)

    const data = res.data as Response<UserSignin>
    if(!data.success) throw new Error(data.error)

    return data.data
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