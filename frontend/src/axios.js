import axios from 'axios'

// Set base URL for axios
axios.defaults.baseURL = 'http://localhost:8000'

// Add a request interceptor to include the bearer token in all requests
axios.interceptors.request.use(
  config => {
    const token = localStorage.getItem('auth_token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  error => {
    return Promise.reject(error)
  }
)

// Add a response interceptor to handle errors
axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 401) {
      localStorage.removeItem('auth_token')
      delete axios.defaults.headers.common['Authorization']
    }
    return Promise.reject(error)
  }
)

export default axios