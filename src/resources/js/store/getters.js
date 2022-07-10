import {axiosInstance} from "../service/api";

export default {
    getLastNotes() {
        axios.get('/api/start')
            .then(response => console.log(response))
            .catch(error => console.log(error))
    }
}
