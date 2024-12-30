<template>
  <div class="dashboard-container">
    <!-- Header -->
    <div class="header">
      <h1>Dashboard</h1>
      <button @click="logout" class="logout-btn">Logout</button>
    </div>

    <!-- Main content area -->
    <div class="main-content">
      <!-- Additional dashboard content can go here -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardPage',
  methods: {
    logout () {
      localStorage.removeItem('auth_token')
      delete this.$axios.defaults.headers.common.Authorization
      this.$router.push({ name: 'HomePage' })
    }
  }
}
</script>

<style scoped>
/* Dashboard container styles */
.dashboard-container {
  background-color: #f4f4f4;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding: 20px;
}

/* Header section with "Dashboard" title and logout button */
.header {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header h1 {
  font-family: "Inter", sans-serif;
  font-weight: 600;
  font-size: 24px;
  color: #333;
  margin: 0;
}

.logout-btn {
  padding: 10px 20px;
  background-color: #78a4de;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.logout-btn:hover {
  background-color: #6c94c7;
}

/* Main content area for the dashboard */
.main-content {
  margin-top: 20px;
  width: 100%;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
