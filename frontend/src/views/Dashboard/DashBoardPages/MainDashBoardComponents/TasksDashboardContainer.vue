<template>
  <div class="task-container">
    <button
      v-for="task in tasks"
      :key="task.TaskID"
      class="task-button"
      @click="$emit('task-selected', task)"
    >
      <div class="task-name">{{ task.name }}</div>
      <div class="task-project">{{ task.ProjectName }}</div>
      <div class="task-date">{{ formatDate(task.EndDate) }}</div>
    </button>
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  name: 'TasksDashboardContainer',
  data () {
    return {
      tasks: [
        // Mock data for development
        {
          TaskID: '1',
          UserID: '123',
          name: 'Complete Design',
          ProjectName: 'Redesign Website',
          ProjectID: 1,
          message: 'Review pending designs.',
          EndDate: '2024-01-15T00:00:00Z'
        },
        {
          TaskID: '2',
          UserID: '123',
          name: 'Fix Bugs',
          ProjectName: 'Backend Services',
          ProjectID: 2,
          message: 'Resolve critical issues.',
          EndDate: '2024-01-20T00:00:00Z'
        },
        {
          TaskID: '3',
          UserID: '123',
          name: 'Write Documentation',
          ProjectName: 'API Project',
          ProjectID: 2,
          message: 'Add endpoint details to the README.',
          EndDate: '2024-01-25T00:00:00Z'
        },
        {
          TaskID: '4',
          UserID: '123',
          name: 'Test Feature',
          ProjectName: 'Frontend App',
          ProjectID: 4,
          message: 'Verify UI responsiveness.',
          EndDate: '2024-01-30T00:00:00Z'
        },
        {
          TaskID: '5',
          UserID: '123',
          name: 'Deploy Service',
          ProjectName: 'Cloud Deployment',
          ProjectID: 5,
          message: 'Set up CI/CD pipeline.',
          EndDate: '2024-02-05T00:00:00Z'
        },
        {
          TaskID: '5',
          UserID: '123',
          name: 'Deploy Service',
          ProjectName: 'Cloud Deployment',
          ProjectID: 6,
          message: 'Set up CI/CD pipeline.',
          EndDate: '2024-02-05T00:00:00Z'
        },
        {
          TaskID: '5',
          UserID: '123',
          name: 'Deploy Service',
          ProjectName: 'Cloud Deployment',
          ProjectID: 7,
          message: 'Set up CI/CD pipeline.',
          EndDate: '2024-02-05T00:00:00Z'
        }
      ]
    }
  },
  methods: {
    // Uncomment this method and remove the mock data when ready to integrate with the backend
    /*
      async fetchTasks() {
        try {
          const token = localStorage.getItem('auth_token'); // Retrieve token from storage
          const response = await axios.get('/GetALLTasks', {
            headers: {
              Authorization: `Bearer ${token}`, // Set Authorization header
            },
          });
          this.tasks = response.data; // Assign fetched tasks to the tasks array
        } catch (error) {
          console.error('Error fetching tasks:', error);
        }
      },
      */
    formatDate (dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' }
      return new Date(dateString).toLocaleDateString(undefined, options)
    }
  }
  // Uncomment the mounted lifecycle hook when ready to integrate with the backend
  /*
    mounted() {
      this.fetchTasks(); // Fetch tasks when the component is mounted
    },
    */
}
</script>

  <style scoped>
  .task-container {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Spacing between buttons */
    padding: 15px; /* Padding inside the container */
    width: 100%;
    height: 91,5%; /* Full height of the parent container */
    overflow-y: auto; /* Add vertical scrollbar when content overflows */
    border: 1px solid #ccc; /* Optional: Border for better visual separation */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Box shadow for better styling */
  }

  .task-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: left;
  }

  .task-button:hover {
    background-color: #45a049;
  }

  .task-name {
    font-size: 1.2em;
    font-weight: bold;
  }

  .task-project {
    font-size: 1em;
    color: #ddd;
  }

  .task-date {
    font-size: 0.9em;
    color: #aaa;
  }
  </style>
