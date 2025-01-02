<template>
  <div class="messages-container">
    <div v-if="selectedProject" class="message-list">
      <h3>Messages for Project: {{ selectedProject.ProjectName }}</h3>
      <div v-for="message in selectedProject.ProjectMessages" :key="message.MessageID" class="message">
        <p><strong>{{ message.nameSender }}:</strong> {{ message.Message }}</p>
        <p><em>{{ formatDate(message.DateSend) }}</em></p>
      </div>
    </div>
    <button @click="createMessage" class="create-message-button">Create Message</button>
  </div>
</template>

<script>
export default {
  name: 'AllMessagesComponent',
  props: {
    selectedProject: Object
  },
  methods: {
    formatDate (date) {
      return new Date(date).toLocaleString()
    },
    createMessage () {
      this.$emit('create-message')
    }
  }
}
</script>

<style scoped>
.message-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.message {
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 5px;
}
.create-message-button {
  margin-top: 10px;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.create-message-button:hover {
  background-color: #45a049;
}
</style>
