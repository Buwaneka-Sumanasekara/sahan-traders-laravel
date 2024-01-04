import axios from 'axios'

var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


export const getAxios = () => {
  const timeout=import.meta.env.VITE_AXIOS_TIMEOUT
  const axiosInstance = axios.create({
    baseURL: '/web-api',
    timeout: timeout
      ? parseInt(timeout)
      : 0,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': laravelToken,
    },
  })

  return axiosInstance
}


