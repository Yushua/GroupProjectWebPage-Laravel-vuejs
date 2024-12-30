<template>
  <div id="app">
    <!-- Tasks Dashboard -->
    <nav class="TaskDashboard-container">
      <TasksDashboardContainer @task-selected="selectTask" />
    </nav>

    <!-- Task Details -->
    <nav class="TaskFullDashboard-container">
      <TaskFullDashboard
        :task="selectedTask"
        @project-id-selected="selectProject"
      />
    </nav>

    <!-- Project Details -->
    <nav class="ProjectDashboard-container">
      <ProjectDashboard :project="selectedProject" />
    </nav>

    <!-- Message Dashboard -->
    <nav class="MessageDashboard-container">
      <MessageDashboard />
    </nav>
  </div>
</template>

<script>
import TasksDashboardContainer from './MainDashBoardComponents/TasksDashboardContainer.vue'
import TaskFullDashboard from './MainDashBoardComponents/TaskFullDashboard.vue'
import ProjectDashboard from './MainDashBoardComponents/ProjectDashboard.vue'
import MessageDashboard from './MainDashBoardComponents/MessageDashboard.vue'

export default {
  name: 'DashboardMainPage',
  components: {
    TasksDashboardContainer,
    TaskFullDashboard,
    ProjectDashboard,
    MessageDashboard
  },
  data () {
    return {
      selectedTask: null, // Currently selected task
      selectedProject: null // Currently selected project
    }
  },
  methods: {
    // Select a task and update selectedTask
    selectTask (task) {
      this.selectedTask = task // Update the selected task
    },

    // Select a project when the ProjectID is selected
    selectProject (projectID) {
      // Ensure the projectID is passed as a string
      this.selectedProject = String(projectID) // Convert projectID to string
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
  width: 470px;
  height: 815px;
  background-color: #2c3e50;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 13px; /* Adds spacing between buttons */
}
</style>
