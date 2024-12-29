<template>
    <div class="login-object">
      <!-- Username Section -->
      <div class="input-section">
        <label for="username" class="input-label">Username</label>
        <input
          type="text"
          id="username"
          v-model="username"
          class="input-field"
        />
        <div v-if="usernameError" class="error-message">Forgot your Username?</div>
      </div>

      <!-- Password Section -->
      <div class="input-section">
        <label for="password" class="input-label">Password</label>
        <input
          type="password"
          id="password"
          v-model="password"
          class="input-field"
        />
        <div v-if="passwordError" class="error-message">Forgot your Password?</div>
      </div>

      <!-- Login Button -->
      <button class="login-btn" @click="login">Login</button>

      <!-- Error Message -->
      <div v-if="loginError" class="error-message">{{ loginError }}</div>
    </div>
</template>

<script>
import axios from 'axios' // Assuming you're using axios

export default {
  name: 'LoginObject',
  data () {
    return {
      username: '',
      password: '',
      usernameError: false,
      passwordError: false,
      loginError: '' // To hold error message
    }
  },
  methods: {
    async login () {
      try {
        // Simulate login process
        const response = await axios.post('/login', {
          username: this.username,
          password: this.password
        })

        if (response && response.data && response.data.token) {
          this.loginError = '' // Clear any previous errors
          // Handle successful login (store token, redirect, etc.)
        }
      } catch (error) {
        // Handle different error responses
        if (error.response) {
          // If user does not exist
          if (error.response.status === 404 && error.response.data.error === 'User not found') {
            this.loginError = "User doesn't exist"
          } else if (error.response.status === 401 && error.response.data.error === 'Invalid password') {
            this.loginError = 'Password wrong'
          } else {
            this.loginError = 'Login failed. Please try again.'
          }
        } else {
          this.loginError = 'An unexpected error occurred.'
        }
      }
    }
  }
}
</script>

<style scoped>
/* LoginObject style without positioning */
.login-object {
  width: 350px; /* Set width */
  height: 280px; /* Set height */
  background-color: #fbe9e9; /* Placeholder background color */
  border-radius: 8px; /* Optional rounded corners */
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  justify-content: center; /* Vertically center all items inside */
  align-items: center; /* Horizontally center all items inside */
}

/* Input Section (Username/Password) */
.input-section {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%; /* Allow the input fields to take full width */
}

/* Label for the input fields */
.input-label {
  font-family: "Inter", sans-serif;
  font-weight: 300; /* Light */
  font-size: 16px;
  color: #000;
}

/* Input field styling */
.input-field {
  padding: 8px;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  background-color: #fbe9e9; /* Background color */
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Error message styling */
.error-message {
  font-family: "Inter", sans-serif;
  font-weight: 300; /* Light */
  font-size: 16px;
  color: red;
  margin-top: 4px;
}

/* Login Button */
.login-btn {
  width: 140px;
  height: 40px;
  background-color: #78a4de; /* Blue */
  color: white;
  font-family: "Inter", sans-serif;
  font-weight: 500; /* Medium */
  font-size: 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login-btn:hover {
  background-color: #6c94c7; /* Darker blue on hover */
}
</style>
