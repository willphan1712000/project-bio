import { create } from 'apisauce';
import authStorage from '../auth/storage';
import auth from '../auth/auth';

export type Response<DataType> = {
    success: boolean;
    data: DataType;
    error?: string;
};

const apiClient = create({
    baseURL: '/',
});

/**
 * Add jwt token to the request headers automatically
 */
apiClient.addAsyncRequestTransform(async (request) => {
    if (!request.headers) request.headers = {};

    request.headers['secret'] = process.env.SYSTEM_SECRET_KEY || '';

    const token = authStorage.getToken();
    if (!token) return;
    request.headers[authStorage.key] = token;
});

/**
 * Handle 401 error code. Log the current user out if 401 is detected
 */
apiClient.addResponseTransform((response) => {
    if (response.status === 401 && response.config?.url !== '/api/auth/check') {
        // If we get an unauthorized, log the user out.
        auth.logout();
    }
});

export default apiClient;
