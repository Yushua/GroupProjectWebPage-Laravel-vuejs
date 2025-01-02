<template>
  <div class="project-container">
    <button
      v-for="project in projects"
      :key="project.ProjectID"
      class="project-button"
      @click="$emit('project-selected', project.ProjectID)"
    >
      <div class="project-name">{{ project.ProjectName }}</div>
      <div class="project-description">{{ project.ProjectDescription }}</div>
      <div class="project-status">{{ project.ProjectStatus }}</div>
    </button>
  </div>
</template>

<script>
export default {
  name: 'AllProjectsComponent',
  data () {
    return {
      projects: [
        {
          ProjectID: '1',
          ProjectName: 'Redesign Website',
          ProjectDescription: 'A project to revamp the website.',
          ProjectStatus: 'Editing'
        },
        {
          ProjectID: '2',
          ProjectName: 'Cloud Deployment',
          ProjectDescription: 'Deploying to the cloud.',
          ProjectStatus: 'Public'
        },
        {
          ProjectID: '3',
          ProjectName: 'Backend Optimization',
          ProjectDescription: 'Optimizing backend performance.',
          ProjectStatus: 'Private'
        }
      ]
    }
  }
}
</script>

<style scoped>
/* Kept unchanged from your current styles */
.project-container {
  display: flex;
  flex-direction: column;
  gap: 15px;
  padding: 15px;
  overflow-y: auto;
}

.project-button {
  display: flex;
  flex-direction: column;
  padding: 15px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.project-button:hover {
  background-color: #45a049;
}

.project-name {
  font-size: 1.2em;
  font-weight: bold;
}

.project-description {
  font-size: 1em;
}

.project-status {
  font-size: 0.9em;
}
</style>
