<template>
  <div class="register-object">
    <div class="input-section">
      <label for="username" class="input-label">Username</label>
      <input type="text" id="username" v-model="username" class="input-field" />
      <div v-if="usernameError" class="error-message">Username Already in Use</div>
    </div>

    <div class="input-section">
      <label for="password" class="input-label">Password</label>
      <input type="password" id="password" v-model="password" class="input-field" />
      <div v-if="passwordError" class="error-message">Password is required</div>
    </div>

    <div class="input-section">
      <label for="confirmPassword" class="input-label">Confirm Password</label>
      <input
        type="password"
        id="confirmPassword"
        v-model="confirmPassword"
        class="input-field"
      />
      <div v-if="passwordMismatch" class="error-message">Passwords do not match</div>
    </div>

    <button class="register-btn" @click="register">Register</button>

    <div v-if="registerError" class="error-message">{{ registerError }}</div>
    <div v-if="registerSuccess" class="success-message">Registration Successful!</div>
  </div>
</template>

<script>
import api from '@/api'

export default {
  name: 'RegisterObject',
  data () {
    return {
      username: '',
      password: '',
      confirmPassword: '',
      usernameError: false,
      passwordError: false,
      passwordMismatch: false,
      registerError: '',
      registerSuccess: false
    }
  },
  methods: {
    async register () {
      this.registerError = ''
      this.usernameError = false
      this.passwordError = false
      this.passwordMismatch = false

      // Validate fields
      if (!this.username || !this.password || !this.confirmPassword) {
        this.registerError = 'All fields are required'
        return
      }

      // Check if password matches confirmPassword
      if (this.password !== this.confirmPassword) {
        this.passwordMismatch = true
        return
      }

      try {
        const response = await api.post('/register', {
          username: this.username, // Correct order: username first
          password: this.password, // Then password
          password_confirmation: this.confirmPassword // Send the confirmPassword as password_confirmation
        })

        // Success: Clear fields and show success message
        if (response.data.message) {
          this.registerSuccess = true
          this.username = ''
          this.password = ''
          this.confirmPassword = ''
        }
      } catch (error) {
        // Handle registration errors
        if (error.response?.data?.error === 'Username already exists') {
          this.usernameError = true
        } else {
          this.registerError = 'Registration failed. Please try again.'
        }
      }
    }
  }
}
</script>

<style scoped>
.register-object {
  width: 350px;
  height: 400px;
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

.success-message {
  font-family: "Inter", sans-serif;
  font-weight: 300;
  font-size: 16px;
  color: green;
  margin-top: 4px;
}

.register-btn {
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

.register-btn:hover {
  background-color: #6c94c7;
}
</style>
