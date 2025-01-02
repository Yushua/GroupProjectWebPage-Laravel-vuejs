<template>
  <div id="app">
    <div class="button-container">
      <button @click="createProject" class="nav-button">
        Create Project
      </button>
      <button @click="addRole" class="nav-button">
        Add Role
      </button>
      <button @click="addTask" class="nav-button">
        Add Task
      </button>
      <button @click="setupSprint" class="nav-button">
        Setup Sprint
      </button>
      <button @click="deleteProject" class="nav-button">
        Github
      </button>
    </div>

    <nav class="MessageDashboard-container" style="position: absolute; top: 30px; left:263px; width: 367px; height: 400px;">
      <AllProjectsComponent />
    </nav>
    <nav class="MessageDashboard-container" style="position: absolute; top: 30px; left: 652px; width: 367px; height: 400px;">
      <AllRolesComponent />
    </nav>
    <nav class="MessageDashboard-container" style="position: absolute; top: 30px; left: 1041px; width: 367px; height: 400px;">
      <AllMessagesComponent />
    </nav>
  </div>
</template>

<script>
export default {
  name: 'DashboardProjectPage',
  components: {
    AllProjectsComponent: () => import('./ProjectPageComponents/AllProjectsComponent.vue'),
    AllRolesComponent: () => import('./ProjectPageComponents/AllRolesComponent.vue'),
    AllMessagesComponent: () => import('./ProjectPageComponents/AllMessagesComponent.vue')
  },
  data () {
    return {}
  },
  methods: {
    createProject () {
      console.log('Creating project...')
      // Replace with actual HTTP request logic
      // this.$axios.post('/projects', { ... })
    },
    addRole () {
      console.log('Adding role...')
      // Replace with actual HTTP request logic
      // this.$axios.post('/roles', { ... })
    },
    addTask () {
      console.log('Adding task...')
      // Replace with actual HTTP request logic
      // this.$axios.post('/Roles', { ... })
    },
    setupSprint () {
      console.log('Setting up sprint...')
      // Replace with actual HTTP request logic
      // this.$axios.post('/sprints', { ... })
    },
    deleteProject () {
      console.log('Deleting project...')
      // Replace with actual HTTP request logic
      // this.$axios.delete('/projects/:id')
    }
  }
}
</script>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.button-container {
  position: relative;
  display: flex;
  flex-direction: column;
  top: -50px!important;
  left: -10px!important;
  gap: 15px;
  margin: 20px;
}

.nav-button {
  width: 210px;
  height: 54px;
  padding: 10px;
  background-color: #ffffff;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  line-height: 34px;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-weight: 300;
}

.nav-button:hover {
  background-color: #ececec;
}
</style>
