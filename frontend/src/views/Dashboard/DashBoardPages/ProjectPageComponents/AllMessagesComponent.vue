<template>
  <div class="message-container">
    <div v-if="projectID">
      <h3>Messages for Project ID: {{ projectID }}</h3>
      <div v-for="message in filteredMessages" :key="message.MessageID" class="message-item">
        <strong>{{ message.nameSender }}</strong> - {{ message.Headline }}
      </div>
    </div>
    <div v-else>
      <p>No project selected.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AllMessagesComponent',
  props: {
    projectID: {
      type: [String, Number],
      required: true
    }
  },
  data () {
    return {
      messages: [
        {
          MessageID: '1',
          ProjectID: '1',
          nameSender: 'John Doe',
          Headline: 'Meeting Reminder'
        }
      ]
    }
  },
  computed: {
    filteredMessages () {
      return this.messages.filter(msg => msg.ProjectID === this.projectID)
    }
  }
}
</script>

<style scoped>
.message-container {
  padding: 15px;
}
</style>
