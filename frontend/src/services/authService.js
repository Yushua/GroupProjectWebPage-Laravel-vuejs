import api from '@/api' // your API instance

let tokenChecked = false

export const checkToken = async () => {
  if (tokenChecked) return Promise.resolve(true) // Already checked

  tokenChecked = true

  const token = localStorage.getItem('auth_token')
  if (token) {
    try {
      const response = await api.get('/verify-token', { headers: { Authorization: `Bearer ${token}` } })
      if (response.status === 200) {
        console.log('Token is valid', response.data)
        return Promise.resolve(true)
      }
    } catch (error) {
      console.error('Token validation failed', error)
      localStorage.removeItem('auth_token')
    }
  }
  return Promise.resolve(false)
}

export default {
  checkToken
}
