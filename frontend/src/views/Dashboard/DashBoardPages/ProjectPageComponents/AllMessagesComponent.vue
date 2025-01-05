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
          TypeMessage: 'project',
          TypeId: '1', // applies to the ID, so look up all Messages with project and this ID
          nameSender: 'John Doe',
          Headline: 'Meeting Reminder'
        },
        {
          MessageID: '2',
          TypeMessage: 'project',
          TypeId: '1',
          nameSender: 'Jane Smith',
          Headline: 'Task Update'
        },
        {
          MessageID: '3',
          TypeMessage: 'project',
          TypeId: '1',
          nameSender: 'Alex Johnson',
          Headline: 'New Task Assigned'
        }
      ]
    }
  },
  computed: {
    filteredMessages () {
      return this.messages.filter(msg => String(msg.ProjectID) === String(this.projectID))
    }
  }
}
</script>

<style scoped>
.message-container {
  padding: 15px;
  width: 98.5%;
}
.message-item {
  display: flex;
  flex-wrap: wrap;
  display: block;
  background-color: #4caf50;
  color: white;
  padding: 10px;
  margin: 5px 0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  overflow-y: auto;
}

</style>
