<template>
    <div class="task-details-container">
      <div v-if="task" class="task-header">
        <div class="task-name">{{ task.name }}</div>
        <div class="task-project">{{ task.ProjectName }}</div>
        <div class="task-date">{{ formatDate(task.EndDate) }}</div>
      </div>

      <div v-if="task" class="task-message-box">
        <button
          class="task-message"
          @click="$emit('project-id-selected', task.ProjectID)"
        >
          {{ task.message }}
        </button>
      </div>

      <div v-else class="placeholder">
        Select a task to view details.
      </div>
    </div>
  </template>

<script>
export default {
  name: 'TaskFullDashboard',
  props: {
    task: {
      type: Object,
      default: null
    }
  },
  methods: {
    formatDate (dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' }
      return new Date(dateString).toLocaleDateString(undefined, options)
    }
  }
}
</script>

  <style scoped>
  .task-details-container {
    display: flex;
    flex-direction: column;
    padding: 15px;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    color: #000;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .task-header {
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .task-name {
    font-size: 1.5em;
    font-weight: bold;
  }

  .task-project {
    font-size: 1.2em;
    color: #ddd;
  }

  .task-date {
    font-size: 1em;
    color: #aaa;
  }

  .task-message-box {
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .task-message {
    font-size: 1em;
    color: #333;
    background-color: #f5f5f5;
    border: none;
    padding: 10px;
    cursor: pointer;
  }

  .placeholder {
    font-size: 1em;
    color: #aaa;
    text-align: center;
  }
  </style>
