<template>
  <div class="dialog-overlay" @click="closeDialog">
    <div class="dialog-content" @click.stop>
      <h3>Create Project</h3>
      <form @submit.prevent="createProject">
        <div class="form-group">
          <label for="project-name">Project Name:</label>
          <input
            type="text"
            id="project-name"
            v-model="newProject.ProjectName"
            required
            placeholder="Enter project name"
          />
        </div>
        <div class="form-group">
          <label for="project-description">Project Description:</label>
          <textarea
            id="project-description"
            v-model="newProject.ProjectDescription"
            required
            placeholder="Enter project description"
          ></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
        <button type="button" class="close-btn" @click="closeDialog">Close</button>
      </form>
    </div>
  </div>
</template>

<script>
import api from '@/api'

export default {
  name: 'CreateProjectDialog',
  data () {
    return {
      newProject: {
        ProjectName: '',
        ProjectDescription: ''
      }
    }
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    async createProject () {
      try {
        const token = localStorage.getItem('auth_token')
        const response = await api.post('/CreateProject', this.newProject, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })

        // Check if the request was successful
        if (response.status === 200) {
          const createdProject = response.data
          alert('Project created successfully!')
          this.$emit('project-created', createdProject)
        } else {
          const errorMessage = response.data.message || 'Failed to create project'
          alert(`Error: ${errorMessage}`)
        }
      } catch (error) {
        console.error('Error creating project:', error)
        alert('An unexpected error occurred. Please try again later.')
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
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  padding: 10px;
}

.dialog-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 600px;
  max-width: 90%;
}

textarea {
  width: 80%;
  height: 100px;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;
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
</style>
