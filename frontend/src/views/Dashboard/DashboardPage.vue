<template>
    <div>
      <h1>Dashboard</h1>
      <button @click="logout">Logout</button>
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
  /* Add your styles here */
  </style>
