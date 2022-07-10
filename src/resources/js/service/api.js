import axios from 'axios';

const config = {
    withCredentials: true,
    baseURL: 'http://example.palmo/'
}

const axiosInstance = axios.create(config);

export {
    axiosInstance
}
