<template>
    <div class="login-object">
      <div class="input-section">
        <label for="username" class="input-label">Username</label>
        <input type="text" id="username" v-model="username" class="input-field" />
        <div v-if="usernameError" class="error-message">Forgot your Username?</div>
      </div>

      <div class="input-section">
        <label for="password" class="input-label">Password</label>
        <input type="password" id="password" v-model="password" class="input-field" />
        <div v-if="passwordError" class="error-message">Forgot your Password?</div>
      </div>

      <button class="login-btn" @click="login">Login</button>

      <div v-if="loginError" class="error-message">{{ loginError }}</div>
    </div>
  </template>

<script>
import api from '@/api'

export default {
  name: 'LoginObject',
  data () {
    return {
      username: '',
      password: '',
      usernameError: false,
      passwordError: false,
      loginError: ''
    }
  },
  methods: {
    async login () {
      if (!this.username || !this.password) {
        this.loginError = 'Username and password are required'
        return
      }

      try {
        const response = await api.post('/login', {
          username: this.username,
          password: this.password
        })

        if (response.data.token) {
        // Store token in localStorage
          localStorage.setItem('token', response.data.token)
          this.loginError = ''
          // Redirect to Dashboard or home page after successful login
          this.$router.push('/dashboard')
        }
      } catch (error) {
        if (error.response?.data?.error === 'User not found') {
          this.loginError = "User doesn't exist"
        } else if (error.response?.data?.error === 'Invalid password') {
          this.loginError = 'Password wrong'
        } else {
          this.loginError = 'Login failed. Please try again.'
        }
      }
    }
  }
}
</script>

  <style scoped>
  .login-object {
    width: 350px;
    height: 280px;
    background-color: #fbe9e9;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: center;
  }

  .input-section {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
  }

  .input-label {
    font-family: "Inter", sans-serif;
    font-weight: 300;
    font-size: 16px;
    color: #000;
  }

  .input-field {
    padding: 8px;
    font-family: "Inter", sans-serif;
    font-size: 16px;
    background-color: #fbe9e9;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .error-message {
    font-family: "Inter", sans-serif;
    font-weight: 300;
    font-size: 16px;
    color: red;
    margin-top: 4px;
  }

  .login-btn {
    width: 140px;
    height: 40px;
    background-color: #78a4de;
    color: white;
    font-family: "Inter", sans-serif;
    font-weight: 500;
    font-size: 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .login-btn:hover {
    background-color: #6c94c7;
  }
  </style>
