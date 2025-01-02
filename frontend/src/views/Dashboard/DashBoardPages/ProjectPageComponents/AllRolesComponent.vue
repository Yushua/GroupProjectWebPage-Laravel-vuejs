<template>
  <div class="role-container">
    <div v-if="projectID">
      <!-- <h3>Roles for Project ID: {{ projectID }}</h3> -->
      <button
        v-for="role in filteredRoles"
        :key="role.RoleID"
        class="role-button"
        @click="$emit('role-selected', role)"
      >
        <div class="role-name">{{ role.RoleName }}</div>
        <div class="role-name">{{ role.Description }}</div>
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
          ProjectID: '1',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '1',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '1',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '2',
          RoleName: 'Designer',
          ProjectID: '1',
          Description: 'Responsible for design and UI/UX.'
        },
        {
          RoleID: '3',
          RoleName: 'Project Manager',
          ProjectID: '1',
          Description: 'Responsible for overseeing the project.'
        },
        {
          RoleID: '4',
          RoleName: 'Tester',
          ProjectID: '1',
          Description: 'Ensures software quality.'
        },
        {
          RoleID: '5',
          RoleName: 'Business Analyst',
          ProjectID: '1',
          Description: 'Bridges business and technical teams.'
        }
      ]
    }
  },
  computed: {
    filteredRoles () {
      return this.roles.filter(
        (role) => String(role.ProjectID) === String(this.projectID)
      )
    }
  }
}
</script>

<style scoped>
.role-container {
  display: flex;
  flex-wrap: wrap; /* Allows roles to wrap when out of bounds */
  padding: 10px;
  left: -30px;
  overflow-y: auto;
}

.role-button {
  flex: 1 1 200px; /* Minimum width of 200px and flexible */
  max-width: 330px; /* Optional: Set max width for buttons */
  background-color: #4caf50;
  color: white;

  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  margin: 5px; /* Adds margin around buttons */
  width: 800px;
  height: 100px;
  box-sizing: border-box; /* Includes padding and border in width/height */
  overflow-y: auto;
}

.role-button:hover {
  background-color: #45a049;
}

.role-name {
  font-size: 1.2em;
}
</style>
