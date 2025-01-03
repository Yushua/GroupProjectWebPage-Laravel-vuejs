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
            <button type="submit" class="submit-btn">Create</button>
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
      description: ''
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
      }
    },
    async createRole () {
      if (!this.selectedRoleName || !this.description) {
        alert('Please fill in all fields.')
        return
      }
      try {
        const token = localStorage.getItem('token')
        const payload = {
          project_id: this.projectID, // Make sure it's 'project_id', matching the DB column
          roleName: this.selectedRoleName, // This should match 'RoleName' in DB
          description: this.description // This should match 'Description' in DB
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
        alert('An error occurred while creating the role.')
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
  }

  .form-group {
    margin-bottom: 15px;
  }

  textarea {
    width: 90%;
    height: 100px;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  select {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  button {
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
  }

  button:hover {
    background-color: #34495e;
  }

  .close-btn {
    background-color: #c0392b;
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
  </style>
