<template>
    <div class="dialog-overlay" @click="closeDialog">
      <div class="dialog-content" @click.stop>
        <h3>Add Task</h3>
        <form @submit.prevent="createTask">
          <div class="form-group">
            <label for="taskName">Task Name:</label>
            <input
              type="text"
              id="taskName"
              v-model="taskName"
              required
              placeholder="Enter task name"
            />
          </div>
          <div class="form-group">
            <label for="taskDescription">Description:</label>
            <textarea
              id="taskDescription"
              v-model="taskDescription"
              required
              placeholder="Enter task description"
            ></textarea>
          </div>
          <div class="form-group">
            <label for="taskDate">Task Date:</label>
            <input
              type="date"
              id="taskDate"
              v-model="taskDate"
              required
            />
          </div>
          <div class="button-group">
            <button type="button" @click="closeDialog" class="close-btn">Cancel</button>
            <button type="submit" class="submit-btn">Create Task</button>
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
    },
    roleID: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      taskName: '',
      taskDescription: '',
      taskDate: '' // Date field for task
    }
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    async createTask () {
      if (!this.taskName || !this.taskDescription || !this.taskDate) {
        alert('Please fill in all fields.')
        return
      }
      try {
        const token = localStorage.getItem('token')
        const payload = {
          projectId: this.projectID,
          roleId: this.roleID.roleId,
          taskName: this.taskName,
          taskDescription: this.taskDescription,
          taskDate: this.taskDate // Include the task date in payload
        }
        const response = await api.post('/createTask', payload, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        if (response.status === 201) {
          alert('Task created successfully.')
          this.$emit('task-created')
          this.$emit('close')
        }
      } catch (error) {
        console.error('Error creating task:', error)
        alert('An error occurred while creating the task.')
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

  input[type="date"] {
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
