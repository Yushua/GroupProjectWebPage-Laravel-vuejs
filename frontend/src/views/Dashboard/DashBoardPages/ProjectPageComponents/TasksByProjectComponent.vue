<template>
  <div class="tasks-container">
    <h2 class="LogoText-text">Tasks by Project</h2>
    <div v-if="tasks.length" class="task-list">
      <!-- Render tasks if available -->
      <div v-for="task in tasks" :key="task.taskId" class="task-item">
        <h3>{{ task.TaskName }}</h3>
        <p><strong>Date:</strong> {{ task.TaskDate }}</p>
        <p>{{ task.TaskDescription }}</p>
      </div>
    </div>
    <p v-else>No tasks found for this project.</p> <!-- Show fallback message if no tasks -->
  </div>
</template>

<script>
import api from '@/api'

export default {
  name: 'TasksByProjectComponent',
  props: {
    projectID: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      tasks: [] // Holds the fetched tasks
    }
  },
  watch: {
    // Watch for changes in projectID and re-fetch tasks
    projectID: {
      immediate: true, // Trigger fetchTasks when the component is mounted
      handler: 'fetchTasks'
    }
  },
  methods: {
    async fetchTasks () {
      // Fetch tasks for the provided project ID
      const token = localStorage.getItem('token')
      if (!this.projectID) {
        console.warn('Project ID is not set. Skipping fetch.')
        return
      }
      try {
        const response = await api.post(
          '/tasksByProject',
          { projectId: this.projectID },
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )
        this.tasks = response.data.tasks || []
        console.log('Fetched tasks:', this.tasks) // Debugging log
      } catch (error) {
        console.error('Failed to fetch tasks by project:', error)
      }
    }
  }
}
</script>

<style scoped>
.tasks-container {
  height: 95%;
  width: 100%;
  overflow-y: auto;
  padding: 10px;
  top: -50px;
}

.task-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.task-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.LogoText-text {
  font-family: 'Inter', sans-serif;
  font-weight: 20; /* Semi-bold */
  font-size: 36px;
  color: #e4e4e4;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}
</style>
