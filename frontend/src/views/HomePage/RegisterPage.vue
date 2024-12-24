<template>
  <div>
    <h1>Register</h1>
    <form @submit.prevent="register">
      <input type="text" v-model="username" placeholder="Username" />
      <input type="password" v-model="password" placeholder="Password" />
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
        const response = await axios.post('/create-account', {
          username: this.username,
          password: this.password
        })
        const token = response.data.token
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        localStorage.setItem('auth_token', token)
        this.message = 'Registration successful!'

        // Redirect to DashboardPage
        this.$router.push({ name: 'DashboardPage' })
      } catch (error) {
        this.message = error.response.data.message
      }
    }
  }
}
</script>
