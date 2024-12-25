<template>
  <div>
    <h1>Register</h1>
    <form @submit.prevent="register">
      <input type="text" v-model="username" placeholder="Username" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Register</button>
    </form>
    <p>{{ message }}</p>
  </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'RegisterPage',
  data () {
    return {
      username: '',
      password: '',
      message: ''
    }
  },
  methods: {
    async register () {
      try {
        // Fetch CSRF cookie
        await axios.get('/sanctum/csrf-cookie')

        const response = await axios.post('/create-account', {
          username: this.username,
          password: this.password
        })
        if (response && response.data) {
          const token = response.data.token
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          localStorage.setItem('auth_token', token)
          this.message = 'Registration successful!'
          this.$router.push({ name: 'DashboardPage' })
        } else {
          this.message = 'Registration failed. No response data.'
        }
      } catch (error) {
        console.error('Error during registration:', error)
        this.message = error.response?.data?.message || 'Registration failed. Please try again later.'
      }
    }
  }
}
</script>
