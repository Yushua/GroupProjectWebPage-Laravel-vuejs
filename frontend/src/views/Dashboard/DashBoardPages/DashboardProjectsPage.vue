<template>
  <div id="app">
    <div class="button-container">
      <button @click="toggleCreateProjectDialog" class="nav-button">Create Project</button>
      <button @click="toggleAddRoleDialog" class="nav-button" :disabled="!selectedProjectID">Add Role</button>
      <button @click="addTask" class="nav-button">Add Task</button>
      <button @click="setupSprint" class="nav-button">Setup Sprint</button>
      <button @click="deleteProject" class="nav-button">Delete Project</button>
    </div>

    <!-- Create Project Dialog -->
    <CreateProjectDialog
      v-if="isCreateProjectDialogOpen"
      @close="toggleCreateProjectDialog"
      @project-created="handleProjectCreated"
    />

    <!-- Add Role Dialog -->
    <AddRoleDialog
      v-if="isAddRoleDialogOpen"
      :projectID="selectedProjectID"
      @close="toggleAddRoleDialog"
      @role-created="handleRoleCreated"
    />

    <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 30px; left: 270px; width: 735px; height: 400px;"
    >
      <AllProjectsComponent @project-selected="handleProjectSelected" />
    </nav>

    <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 30px; left: 1050px; width: 740px; height: 400px;"
    >
      <AllRolesComponent :projectID="selectedProjectID" />
    </nav>

    <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 470px; left: 30px; width: 1760px; height: 400px;"
    >
      <AllMessagesComponent :projectID="selectedProjectID" />
    </nav>
  </div>
</template>

<script>
import AllProjectsComponent from './ProjectPageComponents/AllProjectsComponent.vue'
import AllRolesComponent from './ProjectPageComponents/AllRolesComponent.vue'
import AllMessagesComponent from './ProjectPageComponents/AllMessagesComponent.vue'
import CreateProjectDialog from './ProjectPageComponents/CreateProjectDialog.vue'
import AddRoleDialog from './ProjectPageComponents/AddRoleDialog.vue'

export default {
  name: 'DashboardProjectPage',
  components: {
    AllProjectsComponent,
    AllRolesComponent,
    AllMessagesComponent,
    CreateProjectDialog,
    AddRoleDialog
  },
  data () {
    return {
      selectedProjectID: null,
      isCreateProjectDialogOpen: false,
      isAddRoleDialogOpen: false
    }
  },
  methods: {
    toggleAddRoleDialog () {
      if (!this.selectedProjectID) {
        alert('Please select a project first.')
        return
      }
      this.isAddRoleDialogOpen = !this.isAddRoleDialogOpen
    },
    handleRoleCreated () {
      console.log('Role created successfully.')
      // Refresh role list if necessary
    },
    handleProjectSelected (projectID) {
      console.log('Selected ProjectID:', projectID)
      this.selectedProjectID = projectID
    },
    toggleCreateProjectDialog () {
      this.isCreateProjectDialogOpen = !this.isCreateProjectDialogOpen
    },
    handleProjectCreated (newProject) {
      console.log('Project Created:', newProject)
      // Refresh project list or handle the new project as needed
    },
    async addTask () {
      console.log('Add Task')
    },
    async setupSprint () {
      console.log('Setup Sprint')
    },
    async deleteProject () {
      console.log('Delete Project')
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
  top: -50px !important;
  left: -10px !important;
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
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  font-weight: 300;
}

.nav-button:disabled {
  background-color: #cccccc;
  cursor: not-allowed;
}

.nav-button:hover:not(:disabled) {
  background-color: #ececec;
}
</style>
