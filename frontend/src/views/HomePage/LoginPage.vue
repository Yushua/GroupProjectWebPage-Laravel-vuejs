<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <input type="text" v-model="username" placeholder="Username" />
      <input type="password" v-model="password" placeholder="Password" />
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
        const response = await axios.post('/login', {
          username: this.username,
          password: this.password
        })
        const token = response.data.token
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        localStorage.setItem('auth_token', token)
        this.message = 'Login successful!'

        // Redirect to DashboardPage
        this.$router.push({ name: 'DashboardPage' })
      } catch (error) {
        this.message = error.response.data.message
      }
    }
  }
}
</script>
