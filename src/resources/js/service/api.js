import axios from 'axios';

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const axiosInstance = axios.create({
    headers: {
        'X-XSRF-TOKEN': token
    },
    baseURL: process.env.VUE_APP_API_URL,

    hideModules: { "bold": true },

    // you can override icons too, if desired
    // just keep in mind that you may need custom styles in your application to get everything to align

    // if the image option is not set, images are inserted as base64
    image: {
        uploadURL: "/api/myEndpoint",
        dropzoneOptions: {}
    },

    // limit content height if you wish. If not set, editor size will grow with content.
    maxHeight: "500px"
});

export { axiosInstance }
