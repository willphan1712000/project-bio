import apiClient, { Response } from '../../../client/api/apiClient';
import auth from '../../../client/auth/auth';
import errorFormat from '../../../client/utilities/errorFormat';

/**
 * Check if the current user is signed in or not
 */
async function getUserSignin() {
    return await auth.validate();
}

/**
 * API handling delete user
 */
async function deleteUser() {
    const res = await apiClient.delete('/api/user/deletetemp');

    const data = res.data as Response<undefined>;

    if (!res.ok) throw new Error(errorFormat(res.problem, data.error));

    return data.success;
}

export default {
    deleteUser,
    getUserSignin,
};
