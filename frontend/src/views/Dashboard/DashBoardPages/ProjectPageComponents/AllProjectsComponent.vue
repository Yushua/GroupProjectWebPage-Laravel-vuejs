<template>
  <div id="app">
    <AllProjectsComponent @project-selected="handleProjectSelection" />
    <TaskFullDashboard :task="selectedTask" />
  </div>
</template>

<script>
import AllProjectsComponent from './components/AllProjectsComponent'
import TaskFullDashboard from './components/TaskFullDashboard'

export default {
  name: 'App',
  components: {
    AllProjectsComponent,
    TaskFullDashboard
  },
  data () {
    return {
      selectedTask: null
    }
  },
  methods: {
    handleProjectSelection (project) {
      // Set the selected task to be displayed
      this.selectedTask = {
        TaskID: '1',
        UserID: '123',
        name: project.ProjectName, // Example: "Redesign Website"
        ProjectName: project.ProjectName,
        message: 'Project message',
        EndDate: '2024-01-15T00:00:00Z'
      }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  margin-top: 60px;
}
</style>
