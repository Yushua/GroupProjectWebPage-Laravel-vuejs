<template>
  <div class="dialog-overlay" @click="closeDialog">
    <div class="dialog-content" @click.stop>
      <h3>Add Role</h3>
      <form @submit.prevent="createRole">
        <div class="form-group">
          <label for="roleName">Role Name:</label>
          <select id="roleName" v-model="selectedRoleName" required>
            <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea
            id="description"
            v-model="description"
            required
            placeholder="Enter role description"
          ></textarea>
        </div>
        <div class="button-group">
          <button type="button" @click="closeDialog" class="close-btn">Cancel</button>
          <button type="submit" class="submit-btn" :disabled="isSubmitting">
            <span v-if="isSubmitting">Creating...</span>
            <span v-else>Create</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import api from '@/api'

export default {
  props: {
    projectID: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      roles: [],
      selectedRoleName: '',
      description: '',
      isSubmitting: false // Add a loading state for better UX
    }
  },
  mounted () {
    this.fetchRoles()
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    async fetchRoles () {
      try {
        const token = localStorage.getItem('token')
        const response = await api.get('/allRoles', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.roles = response.data
      } catch (error) {
        console.error('Error fetching roles:', error)
        alert('Failed to fetch roles. Please try again.')
      }
    },
    async createRole () {
      if (!this.selectedRoleName || !this.description) {
        alert('Please fill in all fields.')
        return
      }
      try {
        this.isSubmitting = true // Set loading state
        const token = localStorage.getItem('token')
        const payload = {
          projectId: this.projectID,
          roleName: this.selectedRoleName,
          description: this.description
        }
        const response = await api.post('/createRole', payload, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        if (response.status === 201) {
          alert('Role created successfully.')
          this.$emit('role-created')
          this.$emit('close')
        }
      } catch (error) {
        console.error('Error creating role:', error)
        alert('An error occurred while creating the role. Please try again.')
      } finally {
        this.isSubmitting = false // Reset loading state
      }
    }
  }
}
</script>

<style scoped>
.dialog-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  padding: 10px;
}

.dialog-content {
  background: white;
  padding: 20px;
  border-radius: 10px;
  width: 500px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h3 {
  margin-bottom: 20px;
  color: #2c3e50;
  font-weight: 600;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: #34495e;
}

textarea,
select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

textarea {
  height: 100px;
}

button {
  padding: 10px;
  background-color: #2c3e50;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  font-weight: bold;
  font-size: 14px;
}

button:hover {
  background-color: #34495e;
}

button:disabled {
  background-color: #bdc3c7;
  cursor: not-allowed;
}

.close-btn {
  background-color: #c0392b;
  margin-right: 10px;
}

.close-btn:hover {
  background-color: #e74c3c;
}

.submit-btn {
  background-color: #27ae60;
}

.submit-btn:hover {
  background-color: #2ecc71;
}

.button-group {
  display: flex;
  justify-content: flex-end;
}
</style>
