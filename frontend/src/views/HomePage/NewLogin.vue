<template>
  <div class="app">
    <!-- Background container -->
    <div class="background">
      <!-- Login window -->
      <div class="login-window">
        <!-- Welcome text -->
        <div class="welcome-text">Welcome to my Project</div>

        <!-- Please Login or Register Text -->
        <div class="login-register-text">Please Login or Register</div>

        <!-- Use LoginObject Component (Empty for now) -->
        <LoginObject />
      </div>
    </div>
  </div>
</template>

<script>
// Import the LoginObject component
import LoginObject from './LoginObject.vue'

export default {
  name: 'HomePage',
  components: {
    LoginObject // Register LoginObject component
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
  position: absolute;
  top: 80px;
  left: 40px;
  width: 670px;
  height: 865px;
  background-color: #d9d9d9; /* Set fill color to D9D9D9 */
  border-radius: 8px; /* Optional: Add rounded corners */
  padding: 0 34px; /* Add padding to the sides of the login window */
}

/* Welcome Text */
.welcome-text {
  position: absolute;
  top: 150px;
  left: 34px;
  width: 500px;
  height: 80px;
  font-family: 'Inter', sans-serif;
  font-weight: 600; /* Semi-bold */
  font-size: 36px;
  color: #000;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

/* Please Login or Register Text (only horizontally centered) */
.login-register-text {
  position: absolute;
  top: 245px; /* Keep the vertical position as is */
  left: 50%; /* Start at 50% of the LoginWindow */
  transform: translateX(-50%); /* Offset the element by 50% of its width to center it */
  width: 413px;
  height: 32px;
  font-family: 'Inter', sans-serif;
  font-weight: 200; /* Extra-light */
  font-size: 24px;
  color: rgba(0, 0, 0, 0.6); /* Set opacity to 60% */
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}
</style>
