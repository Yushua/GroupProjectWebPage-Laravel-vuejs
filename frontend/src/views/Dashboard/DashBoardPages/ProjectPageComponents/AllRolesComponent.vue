<template>
  <div class="role-container">
    <div v-if="projectID">
      <h3 class="role-button">Roles for Project ID: {{ projectID }}</h3>
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
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '2',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '2',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '2',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '2',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '3',
          RoleName: 'Project Manager',
          ProjectID: '1',
          Description: 'Responsible for overseeing the project.'
        }
      ]
    }
  },
  computed: {
    filteredRoles () {
      return this.roles.filter(role => String(role.ProjectID) === String(this.projectID))
    }
  }
}
</script>

<style scoped>
.role-container {
  padding: 15px;
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}
.role-button {
  display: flex;
  flex-wrap: wrap;
  display: block;
  background-color: #4caf50;
  color: white;
  padding: 10px;
  margin: 5px 0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.role-button:hover {
  background-color: #45a049;
}

.role-name {
  font-size: 1.2em;
}
</style>
