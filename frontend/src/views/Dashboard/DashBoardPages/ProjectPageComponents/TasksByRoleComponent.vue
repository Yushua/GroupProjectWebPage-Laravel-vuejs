<template>
    <div class="tasks-container">
      <h2>Tasks by Role</h2>
      <div v-if="tasks.length" class="task-list">
        <div v-for="task in tasks" :key="task.taskId" class="task-item">
          <h3>{{ task.TaskName }}</h3>
          <p><strong>Date:</strong> {{ task.TaskDate }}</p>
          <p>{{ task.TaskDescription }}</p>
        </div>
      </div>
      <p v-else>No tasks found for this role.</p>
    </div>
  </template>

<script>
import api from '@/api'

export default {
  name: 'TasksByRoleComponent',
  props: {
    projectID: {
      type: String,
      required: true
    },
    roleID: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      tasks: []
    }
  },
  watch: {
    projectID: 'fetchTasks',
    roleID: 'fetchTasks'
  },
  methods: {
    async fetchTasks () {
      const token = localStorage.getItem('token')
      if (!this.projectID || !this.roleID || !token) return
      try {
        const response = await api.post('/tasksByRole', {
          projectId: this.projectID,
          roleId: this.roleID.roleId
        }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.tasks = response.data.tasks || []
      } catch (error) {
        console.error('Failed to fetch tasks by role:', error)
      }
    }
  },
  mounted () {
    this.fetchTasks()
  }
}
</script>

  <style scoped>
  .tasks-container {
    height: 100%;
    overflow-y: auto;
    padding: 10px;
  }

  .task-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .task-item {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }
  </style>
