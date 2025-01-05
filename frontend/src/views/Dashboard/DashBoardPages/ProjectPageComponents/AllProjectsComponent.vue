<template>
  <div class="project-container">
    <button
      v-for="project in projects"
      :key="project.projectId"
      class="project-button"
      @click="$emit('project-selected', project.projectId)"
    >
      <div class="project-name">{{ project.name }}</div>
      <div class="project-description">{{ project.description }}</div>
      <div class="project-status">{{ project.status }}</div>
    </button>
  </div>
</template>

<script>
import api from '@/api'

export default {
  name: 'AllProjectsComponent',
  data () {
    return {
      projects: []
    }
  },
  created () {
    this.fetchProjects()
  },
  methods: {
    async fetchProjects () {
      try {
        const token = localStorage.getItem('token')
        const response = await api.get('/projects', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.projects = response.data
      } catch (error) {
        console.error('Error fetching projects:', error)
        alert('An error occurred while fetching the projects.')
      }
    }
  }
}
</script>

<style scoped>
.project-container {
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 100%!important;
  padding: 15px;
  overflow-y: auto;
}

.project-button {
  display: flex;
  flex-direction: column;
  padding: 15px;
  width: 100%!important;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.project-button:hover {
  background-color: #45a049;
}

.project-name {
  font-size: 1.2em;
  font-weight: bold;
}

.project-description {
  font-size: 1em;
}

.project-status {
  font-size: 0.9em;
}
</style>
