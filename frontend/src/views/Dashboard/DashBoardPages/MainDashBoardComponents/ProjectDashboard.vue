<template>
    <div class="project-details-container">
      <div v-if="project" class="project-header">
        <div class="project-name">{{ project.projectName }}</div>
        <div class="project-id">ID: {{ project.ProjectID }}</div>
      </div>

      <div v-if="project" class="project-message-box">
        <div class="project-message">{{ project.ProjectMessage }}</div>
      </div>

      <div v-else class="placeholder">
        Project template placeholder
      </div>
    </div>
  </template>

<script>
export default {
  name: 'ProjectDashboard',
  props: {
    project: {
      type: [Object, String], // Can be either project object or ProjectID (as string)
      default: null
    }
  },
  computed: {
    selectedProject () {
      // If project is a string (ProjectID), find the corresponding project
      if (typeof this.project === 'string') {
        const mockProjects = [
          {
            projectName: 'Redesign Website',
            ProjectID: '1',
            ProjectMessage: 'This is the redesign project for the company website.'
          },
          {
            projectName: 'Backend Services',
            ProjectID: '2',
            ProjectMessage: 'This is the backend services project.'
          },
          {
            projectName: 'Frontend App',
            ProjectID: '4',
            ProjectMessage: 'This project involves the development of a frontend application.'
          },
          {
            projectName: 'Cloud Deployment',
            ProjectID: '5',
            ProjectMessage: 'This is the cloud deployment project for various services.'
          }
        ]

        // Find the project by ProjectID if passed as string
        const selected = mockProjects.find(project => project.ProjectID === this.project)

        // Log the ProjectID when a new project is selected
        if (selected) {
          console.log(`Project selected: ${this.project}`)
        }

        return selected || null
      } else {
        // If project is already an object, just return it
        return this.project
      }
    }
  }
}
</script>

  <style scoped>
  .project-details-container {
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

  .project-header {
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .project-name {
    font-size: 1.5em;
    font-weight: bold;
  }

  .project-id {
    font-size: 1em;
    color: #aaa;
  }

  .project-message-box {
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .project-message {
    font-size: 1em;
    color: #333;
  }

  .placeholder {
    font-size: 1em;
    color: #aaa;
    text-align: center;
  }
  </style>
