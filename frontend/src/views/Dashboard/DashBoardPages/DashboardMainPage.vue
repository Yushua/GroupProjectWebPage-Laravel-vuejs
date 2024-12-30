<template>
  <div id="app">
    <nav class="TaskDashboard-container">
      hello
    </nav>
    <nav class="TaskFullDashboard-container">
      hello
    </nav>
    <nav class="ProjectDashboard-container">
      hello
    </nav>
    <nav class="MessageDashboard-container">
      hello
    </nav>
  </div>
</template>

<script>

export default {
  name: 'DashboardMainPage',
  components: {
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.TaskDashboard-container {
  position: absolute;
  top: 30px;
  left: 30px;
  width: 630px;
  height: 400px;
  background-color: #2c3e50;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 13px; /* Adds spacing between buttons */
}

.TaskFullDashboard-container {
  position: absolute;
  top: 30px;
  left: 675px;
  width: 630px;
  height: 400px;
  background-color: #2c3e50;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 15px; /* Adds spacing between buttons */
}

.ProjectDashboard-container {
  position: absolute;
  top: 445px;
  left: 30px;
  width: 1275px;
  height: 400px;
  background-color: #2c3e50;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 13px; /* Adds spacing between buttons */
}

.MessageDashboard-container{
  position: absolute;
  top: 30px;
  left: 1320px;
  width: 500px;
  height: 815px;
  background-color: #2c3e50;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 13px; /* Adds spacing between buttons */
}
</style>
