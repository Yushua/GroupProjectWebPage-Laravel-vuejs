<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <input type="text" v-model="username" placeholder="Username" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p>{{ message }}</p>
  </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'LoginPage',
  data () {
    return {
      username: '',
      password: '',
      message: ''
    }
  },
  methods: {
    async login () {
      try {
        // Fetch CSRF cookie
        await axios.get('/sanctum/csrf-cookie')

        const response = await axios.post('/login', {
          username: this.username,
          password: this.password
        })
        if (response && response.data) {
          const token = response.data.token
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          localStorage.setItem('auth_token', token)
          this.message = 'Login successful!'
          this.$router.push({ name: 'DashboardPage' })
        } else {
          this.message = 'Login failed. No response data.'
        }
      } catch (error) {
        console.error('Error during login:', error)
        this.message = error.response?.data?.message || 'Login failed. Please try again later.'
      }
    }
  }
}
</script>
