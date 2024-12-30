<template>
    <div class="message-dashboard-container">
      <!-- List of Messages -->
      <div v-for="message in messages" :key="message.MessageID" class="message-item" @click="openDialog(message)">
        <div class="message-header">
          <strong>{{ message.nameSender }}</strong> - {{ message.Headline }} - {{ formatDate(message.DateSend) }}
        </div>
      </div>

      <!-- Dialog for Message Details -->
      <div v-if="selectedMessage" class="dialog-overlay" @click="closeDialog">
        <div class="dialog-content" @click.stop>
          <h3>Message Details</h3>
          <div class="message-details">
            <p><strong>From:</strong> {{ selectedMessage.nameSender }}</p>
            <p><strong>Headline:</strong> {{ selectedMessage.Headline }}</p>
            <p><strong>Message:</strong> {{ selectedMessage.Message }}</p>
            <p><strong>Sent on:</strong> {{ formatDate(selectedMessage.DateSend) }}</p>

            <!-- Reply Form -->
            <textarea v-model="replyMessage" placeholder="Write your reply..."></textarea>
            <button @click="sendReply">Send Reply</button>
          </div>

          <!-- Close button -->
          <button class="close-btn" @click="closeDialog">Close</button>
        </div>
      </div>
    </div>
  </template>

<script>

export default {
  name: 'MessageDashboard', // Give the component a name (optional but recommended)

  data () {
    return {
      messages: [
        {
          SenderID: '123',
          nameSender: 'John Doe',
          Headline: 'Meeting Reminder',
          DateSend: new Date('2024-12-29T12:00:00'),
          MessageID: 'm1',
          Message: 'Just a reminder about our meeting tomorrow at 3 PM.'
        },
        {
          SenderID: '456',
          nameSender: 'Jane Smith',
          Headline: 'Project Update',
          DateSend: new Date('2024-12-28T10:00:00'),
          MessageID: 'm2',
          Message: 'The project is progressing well, we are on track.'
        }
      ],
      selectedMessage: null,
      replyMessage: ''
    }
  },

  methods: {
    openDialog (message) {
      this.selectedMessage = message
    },

    closeDialog () {
      this.selectedMessage = null
      this.replyMessage = ''
    },

    formatDate (date) {
      return new Date(date).toLocaleString() // Simple date formatting
    },

    sendReply () {
      if (this.replyMessage.trim() !== '') {
        const reply = {
          SenderID: '789', // Simulating "You" as the sender
          nameSender: 'You',
          Headline: `Re: ${this.selectedMessage.Headline}`,
          DateSend: new Date(),
          MessageID: `m${Date.now()}`, // New ID based on timestamp
          Message: this.replyMessage
        }

        // Insert new message at the top
        this.messages.unshift(reply)

        // Close the dialog and clear the reply message
        this.closeDialog()
      }
    }
  }
}
</script>

  <style scoped>
  .message-dashboard-container {
    padding: 20px;
  }

  .message-item {
    margin: 10px 0;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .message-item:hover {
    background-color: #e0e0e0;
  }

  .message-header {
    font-size: 1.2em;
    color: #333;
  }

  /* Basic styling for the dialog overlay */
  .dialog-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* Dialog content styling */
  .dialog-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    max-width: 90%;
  }

  .message-details {
    padding: 20px;
  }

  textarea {
    width: 100%;
    height: 100px;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  button {
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    margin-top: 10px;
  }

  button:hover {
    background-color: #34495e;
  }

  .close-btn {
    background-color: #c0392b;
    margin-top: 10px;
  }

  .close-btn:hover {
    background-color: #e74c3c;
  }
  </style>
