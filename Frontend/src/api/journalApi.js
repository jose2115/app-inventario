
import axios from 'axios'


const journalApi = axios.create({
    baseURL: 'http://127.0.0.1:8000/api'
})

journalApi.interceptors.request.use( (config) => {

    config.params = {
        auth: localStorage.getItem('idToken')
    }

    return config
})


// console.log( process.env.NODE_ENV ) // TEST durante testing, 

export default journalApi


