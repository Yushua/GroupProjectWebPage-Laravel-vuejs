<template>
  <div id="app">
    <div class="button-container">
      <button @click="toggleCreateProjectDialog" class="nav-button">Create Project</button>
      <button @click="toggleAddRoleDialog" class="nav-button" :disabled="!selectedProjectID">Add Role</button>
      <button @click="toggleAddTaskDialog" class="nav-button" :disabled="!selectedRoleID">Add Task</button>
      <button @click="setupSprint" class="nav-button">Setup Sprint</button>
      <button @click="deleteProject" class="nav-button" :disabled="!selectedProjectID">Delete Project</button>
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

    <!-- Add Task Dialog -->
    <AddTaskDialog
      v-if="isAddTaskDialogOpen"
      :projectID="selectedProjectID"
      :roleID="selectedRoleID"
      @close="toggleAddTaskDialog"
      @task-created="handleTaskCreated"
    />

    <!-- all Tasks-->
    <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 885px; left: 30px; width: 1760px; height: 400px;"
    >
      <TasksByProjectComponent
        v-if="selectedProjectID"
        :projectID="selectedProjectID"
      />
    </nav>

    <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 470px; left: 30px; width: 1760px; height: 400px;"
    >
      <TasksByRoleComponent
        v-if="selectedProjectID && selectedRoleID"
        :projectID="selectedProjectID"
        :roleID="selectedRoleID"
      />
    </nav>

    <!-- All Projects -->
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
      <AllRolesComponent
        :projectID="selectedProjectID"
        @role-selected="handleRoleSelected"
      />
    </nav>

    <!-- <nav
      class="MessageDashboard-container"
      style="position: absolute; top: 470px; left: 30px; width: 1760px; height: 400px;"
    >
      <AllMessagesComponent :projectID="selectedProjectID" />
    </nav> -->
  </div>
</template>

<script>
import AllProjectsComponent from './ProjectPageComponents/AllProjectsComponent.vue'
import AllRolesComponent from './ProjectPageComponents/AllRolesComponent.vue'
// import AllMessagesComponent from './ProjectPageComponents/AllMessagesComponent.vue'
import CreateProjectDialog from './ProjectPageComponents/CreateProjectDialog.vue'
import AddRoleDialog from './ProjectPageComponents/AddRoleDialog.vue'
import AddTaskDialog from './ProjectPageComponents/AddTaskDialog.vue'
import TasksByProjectComponent from './ProjectPageComponents/TasksByProjectComponent.vue'
import TasksByRoleComponent from './ProjectPageComponents/TasksByRoleComponent.vue'

export default {
  name: 'DashboardProjectsPage',
  components: {
    AllProjectsComponent,
    AllRolesComponent,
    // AllMessagesComponent,
    CreateProjectDialog,
    AddRoleDialog,
    AddTaskDialog,
    TasksByProjectComponent,
    TasksByRoleComponent
  },
  data () {
    return {
      selectedProjectID: null,
      selectedRoleID: null,
      isCreateProjectDialogOpen: false,
      isAddRoleDialogOpen: false,
      isAddTaskDialogOpen: false
    }
  },
  methods: {
    toggleCreateProjectDialog () {
      this.isCreateProjectDialogOpen = !this.isCreateProjectDialogOpen
    },
    toggleAddRoleDialog () {
      if (!this.selectedProjectID) {
        alert('Please select a project first.')
        return
      }
      this.isAddRoleDialogOpen = !this.isAddRoleDialogOpen
    },
    toggleAddTaskDialog () {
      if (!this.selectedRoleID) {
        alert('Please select a role first.')
        return
      }
      this.isAddTaskDialogOpen = !this.isAddTaskDialogOpen
    },
    handleProjectSelected (projectID) {
      console.log('Selected ProjectID:', projectID)
      this.selectedProjectID = projectID
      this.selectedRoleID = null // Reset role selection on project change
    },
    handleRoleSelected (roleID) {
      console.log('Selected RoleID:', roleID)
      this.selectedRoleID = roleID
    },
    handleProjectCreated (newProject) {
      console.log('Project Created:', newProject)
      // Refresh project list or handle the new project as needed
    },
    handleRoleCreated () {
      console.log('Role created successfully.')
      // Refresh role list if necessary
    },
    handleTaskCreated () {
      console.log('Task created successfully.')
      // Refresh task list if necessary
    },
    async setupSprint () {
      if (!this.selectedProjectID) {
        alert('Please select a project first.')
        return
      }
      console.log('Setup Sprint for Project:', this.selectedProjectID)
    },
    async deleteProject () {
      if (!this.selectedProjectID) {
        alert('Please select a project first.')
        return
      }
      console.log('Delete Project:', this.selectedProjectID)
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
  top: -50px;
  left: -10px;
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

.nav-button:disabled {
  background-color: #cccccc;
  cursor: not-allowed;
}

.nav-button:hover:not(:disabled) {
  background-color: #ececec;
}
</style>
