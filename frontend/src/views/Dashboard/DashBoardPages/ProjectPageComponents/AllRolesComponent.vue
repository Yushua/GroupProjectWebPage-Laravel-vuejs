<template>
  <div class="roles-container">
    <div v-if="selectedProject" class="role-list">
      <h3>Roles in Project: {{ selectedProject.ProjectName }}</h3>
      <div v-for="role in selectedProject.ProjectRoles" :key="role.RoleID" class="role">
        <h4>{{ role.Role }}</h4>
        <div v-for="task in role.Tasks" :key="task.TaskID" class="task">
          <p>{{ task.name }} (Due: {{ formatDate(task.EndDate) }})</p>
        </div>
      </div>
    </div>
    <div v-else>
      <p>No project selected</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AllRolesComponent',
  props: {
    selectedProject: Object
  },
  methods: {
    formatDate (dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' }
      return new Date(dateString).toLocaleDateString(undefined, options)
    }
  }
}
</script>

<style scoped>
.role-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.role {
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 5px;
}
.task {
  margin-left: 10px;
  font-size: 0.9em;
  color: #555;
}
</style>
