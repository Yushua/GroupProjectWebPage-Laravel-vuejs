<template>
  <div class="app">
    <!-- Background container -->
    <div class="background">
      <!-- Login window -->
      <div class="login-window">
        <!-- Welcome text -->
        <div class="welcome-text">Welcome to my Project</div>

        <!-- Buttons for Login and Register -->
        <div class="action-buttons">
          <button class="login-btn" @click="setLogin">Login</button>
          <button class="register-btn" @click="setRegister">Register</button>
        </div>
        <!-- Conditionally render LoginObject or RegisterObject -->
        <LoginObject v-if="isLoginActive" />
        <RegisterObject v-if="!isLoginActive" />
      </div>
      <div class="LogoText-text">Welcome To My Group Project Application Project</div>
    </div>
  </div>
</template>

<script>
// Import the LoginObject and RegisterObject components
import LoginObject from './LoginObject.vue'
import RegisterObject from './RegisterObject.vue'

export default {
  name: 'HomePage',
  components: {
    LoginObject,
    RegisterObject
  },
  data () {
    return {
      isLoginActive: true // Tracks which component to display (Login or Register)
    }
  },
  methods: {
    setLogin () {
      this.isLoginActive = true // Show LoginObject
    },
    setRegister () {
      this.isLoginActive = false // Show RegisterObject
    }
  }
}
</script>

<style scoped>
/* Background */
.app {
  background-color: #2f3233; /* Set background color to 2F3233 */
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Login Window */
.login-window {
  position:fixed; /* Changed to relative positioning */
  width: 470px;
  height: 865px;
  background-color: #969c9e; /* Set fill color to D9D9D9 */
  border-radius: 8px; /* Optional: Add rounded corners */
  padding: 0 34px; /* Add padding to the sides of the login window */
  top: 50px;
  left: 100px; /* Move the entire window 100px to the left */
}

/* Welcome Text */
.welcome-text {
  position: absolute;
  top: 150px;
  left: 14px; /* Adjusted left position (-100px extra) */
  width: 500px;
  height: 80px;
  font-family: 'Inter', sans-serif;
  font-weight: 600; /* Semi-bold */
  font-size: 36px;
  color: #494949;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.LogoText-text {
  position: fixed;
  top: 450px;
  left: 700px; /* Adjusted left position (-100px extra) */
  width: 500px;
  height: 80px;
  font-family: 'Inter', sans-serif;
  font-weight: 600; /* Semi-bold */
  font-size: 36px;
  color: #5f5f5f;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

/* Action Buttons (Login & Register) */
.action-buttons {
  position: absolute;
  top: 245px; /* Position them below the welcome text */
  left: 50%; /* Moved an extra 100px to the left */
  transform: translateX(-50%); /* Center horizontally */
  display: flex;
  gap: 20px; /* Space between the buttons */
}

.login-btn, .register-btn {
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

.login-btn:hover, .register-btn:hover {
  background-color: #6c94c7; /* Darker blue on hover */
}

/* Positioning for LoginObject and RegisterObject */
.login-object, .register-object {
  position: absolute;
  top: 320px; /* Set position below the "Please Login or Register" text */
  left: 50%;  /* Moved an extra 100px to the left */
  transform: translateX(-50%); /* Offset by 50% of its width */
}
</style>
