<template>
  <div class="role-container">
    <div v-if="roles.length > 0">
      <button
        v-for="role in filteredRoles"
        :key="role.RoleID"
        :class="{'role-button': true, 'role-button-unfilled': role.UserID === -1}"
        @click="$emit('role-selected', role)"
      >
        <div class="role-name">{{ role.RoleName }}</div>
        <div class="role-description">{{ role.Description }}</div>
      </button>
    </div>
    <div v-else>
      <p>No roles available for the selected project.</p>
    </div>
  </div>
</template>

<script>
import api from '@/api'

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
      roles: [] // Initially empty, will be populated from the API
    }
  },
  watch: {
    projectID: {
      immediate: true, // Fetch roles when the component is mounted
      handler (newProjectID) {
        this.fetchRoles(newProjectID)
      }
    }
  },
  methods: {
    async fetchRoles (projectID) {
      if (!projectID) {
        this.roles = []
        return
      }
      try {
        const token = localStorage.getItem('token')
        const response = await api.get(`/roles/${projectID}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.roles = response.data
      } catch (error) {
        console.error('Error fetching roles:', error)
        this.roles = [] // Clear roles if an error occurs
      }
    }
  },
  computed: {
    filteredRoles () {
      return this.roles
    }
  }
}
</script>

<style scoped>
.role-container {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  padding: 10px!important; /* Space between buttons */
}

.role-button {
  width: 340px;
  gap: 15px!important;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  box-sizing: border-box;
  height: 100px;
}

.role-button:hover {
  background-color: #45a049;
}

.role-button-unfilled {
  background-color: #f44336; /* Red color for unfilled roles */
}

.role-button-unfilled:hover {
  background-color: #d32f2f; /* Darker red on hover */
}

.role-name {
  font-size: 1.2em;
}

.role-description {
  font-size: 1em;
  color: #ccc;
}

</style>
