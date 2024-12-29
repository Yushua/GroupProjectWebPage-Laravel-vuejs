<template>
  <div class="register-object">
    <!-- Username Section -->
    <div class="input-section">
      <label for="username" class="input-label">Username</label>
      <input
        type="text"
        id="username"
        v-model="username"
        class="input-field"
      />
      <div v-if="usernameError" class="error-message">Username Already in Use</div>
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
      <div v-if="passwordError" class="error-message">Password is required</div>
    </div>

    <!-- Confirm Password Section -->
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

    <!-- Register Button -->
    <button class="register-btn" @click="register">Register</button>

    <!-- Success/Error Message -->
    <div v-if="registerError" class="error-message">{{ registerError }}</div>
    <div v-if="registerSuccess" class="success-message">Registration Successful!</div>
  </div>
</template>

<script>
import axios from 'axios'

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
      registerError: '', // To hold error message
      registerSuccess: false // To show success message on successful registration
    }
  },
  methods: {
    async register () {
      // Reset errors before starting registration
      this.registerError = ''
      this.usernameError = false
      this.passwordError = false
      this.passwordMismatch = false

      // Validate input fields
      if (!this.username || !this.password || !this.confirmPassword) {
        this.registerError = 'All fields are required'
        return
      }

      // Check if passwords match
      if (this.password !== this.confirmPassword) {
        this.passwordMismatch = true
        return
      }

      // Simulate registration API call
      try {
        const response = await axios.post('/register', {
          username: this.username,
          password: this.password
        })

        if (response && response.data && response.data.success) {
          this.registerSuccess = true
          this.clearFields()
        }
      } catch (error) {
        // Handle different error responses
        if (error.response) {
          if (error.response.status === 400 && error.response.data.error === 'Username already exists') {
            this.usernameError = true
          } else {
            this.registerError = 'Registration failed. Please try again.'
          }
        } else {
          this.registerError = 'An unexpected error occurred.'
        }
      }
    },

    // Clears input fields after successful registration
    clearFields () {
      this.username = ''
      this.password = ''
      this.confirmPassword = ''
    }
  }
}
</script>

<style scoped>
/* RegisterObject style */
.register-object {
  width: 350px; /* Set width */
  height: 400px; /* Adjusted height */
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

/* Success message styling */
.success-message {
  font-family: "Inter", sans-serif;
  font-weight: 300; /* Light */
  font-size: 16px;
  color: green;
  margin-top: 4px;
}

/* Register Button */
.register-btn {
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

.register-btn:hover {
  background-color: #6c94c7; /* Darker blue on hover */
}
</style>
