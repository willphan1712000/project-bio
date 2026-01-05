import Cookies from 'js-cookie';
import apiClient, { Response } from '../api/apiClient';
import config from '../config';
import authStorage from './storage';

export type UserSignin =
    | {
          status: boolean;
          username: string;
      }
    | undefined;

// This link is a route that users will be redirected to whenever they logout or invalid login information found
const signInLink = config.routes.signin;

/**
 * Handle talking to the server to check if the current user is signed in
 * @returns Promise<UserSignin> - status of a current user of the current session
 */
async function validate(): Promise<UserSignin> {
    const res = await apiClient.get('/api/auth/check');

    if (!res.ok) throw new Error(res.problem);

    const data = res.data as Response<UserSignin>;

    if (!data.success) throw new Error(data.error);

    const auth = data.data;

    if (!auth) {
        window.location.href = signInLink;
    }

    return auth;
}

/**
 * Handle taking username, password, email to the server to grant a session or a token
 * @param username
 * @param password
 * @param email
 * @returns
 */
async function login(
    username: string,
    password: string,
    email: string
): Promise<any> {
    const res = await apiClient.post('/api/auth', {
        username,
        password,
        email,
    });

    if (!res.ok) throw new Error(res.problem);

    const data = res.data as Response<any>;

    if (!data.success) throw new Error(data.error);

    return data.data;
}

/**
 * Handle logging the current user out
 */
async function logout(): Promise<void> {
    // clear cookies
    Cookies.remove('PHPSESSID');
    // remove token
    authStorage.removeToken();
    // redirect to the login page
    window.location.href = signInLink;
}

export default {
    validate,
    login,
    logout,
};
