<template>
  <div class="role-container">
    <div v-if="projectID">
      <h3>Roles for Project ID: {{ projectID }}</h3>
      <button
        v-for="role in filteredRoles"
        :key="role.RoleID"
        class="role-button"
        @click="$emit('role-selected', role)"
      >
        <div class="role-name">{{ role.RoleName }}</div>
      </button>
    </div>
    <div v-else>
      <p>No project selected.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AllRolesComponent',
  props: {
    projectID: {
      type: [String, Number],
      required: true
    }
  },
  data () {
    return {
      roles: [
        {
          RoleID: '1',
          RoleName: 'Developer',
          ProjectID: '1',
          Description: 'Responsible for coding and implementation.'
        }
      ]
    }
  },
  computed: {
    filteredRoles () {
      return this.roles.filter(role => role.ProjectID === this.projectID)
    }
  }
}
</script>

<style scoped>
.role-container {
  padding: 15px;
}
</style>
