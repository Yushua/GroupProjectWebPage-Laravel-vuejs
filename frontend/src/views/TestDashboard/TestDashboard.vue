<template>
  <div class="login-container">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div class="form-group">
        <input
          type="text"
          v-model="username"
          placeholder="Username"
          required
          class="form-control"
        />
      </div>
      <div class="form-group">
        <input
          type="password"
          v-model="password"
          placeholder="Password"
          required
          class="form-control"
        />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p v-if="message" :class="{'success-message': isSuccess, 'error-message': !isSuccess}">
      {{ message }}
    </p>
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
      message: '',
      isSuccess: false // Tracks if the login was successful
    }
  },
  methods: {
    async login () {
      try {
        // Fetch CSRF cookie for Laravel Sanctum (if needed)
        await axios.get('/sanctum/csrf-cookie')

        // Send login request
        const response = await axios.post('/login', {
          username: this.username,
          password: this.password
        })

        // Check if response contains token
        if (response && response.data && response.data.token) {
          const token = response.data.token
          // Store token in localStorage and set axios default header
          localStorage.setItem('auth_token', token)
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          // Success feedback
          this.message = 'Login successful!'
          this.isSuccess = true
          // Navigate to the dashboard or desired page
          this.$router.push({ name: 'DashboardPage' })
        } else {
          this.message = 'Login failed. Invalid server response.'
          this.isSuccess = false
        }
      } catch (error) {
        // Handle errors
        console.error('Error during login:', error)
        this.message = error.response?.data?.error || 'Login failed. Please try again.'
        this.isSuccess = false
      }
    }
  }
}
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 0 auto;
  text-align: center;
  padding: 1rem;
  background-color: #f9f9f9;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 1rem;
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  font-size: 1rem;
}

.btn {
  padding: 0.5rem 1rem;
  font-size: 1rem;
}

.success-message {
  color: green;
}

.error-message {
  color: red;
}
</style>
