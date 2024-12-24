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
import axios from 'axios'

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
        const response = await axios.post('http://localhost:8000/create-account', {
          username: this.username,
          password: this.password
        })
        this.message = response.data.message
      } catch (error) {
        this.message = error.response.data.message
      }
    }
  }
}
</script>
