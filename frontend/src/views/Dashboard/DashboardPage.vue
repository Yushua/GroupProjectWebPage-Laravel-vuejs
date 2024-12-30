<template>
  <div class="dashboard">
    <!-- Button container in the top-left corner -->
    <nav class="button-container">
      <!-- Render buttons for each page -->
      <button
        v-for="page in pages"
        :key="page.file"
        @click="navigateTo(page)"
        class="nav-button"
      >
        {{ page.name }}
      </button>
    </nav>

    <!-- Display the content of the selected page -->
    <div class="page-content">
      <component :is="currentPage"></component>
    </div>

    <!-- Logout button -->
    <button @click="logout" class="logout-button">Logout</button>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import DashboardMainPage from './DashBoardPages/DashboardMainPage.vue'
import DashboardMessagePage from './DashBoardPages/DashboardMessagePage.vue'
import DashboardTaskPage from './DashBoardPages/DashboardTaskPage.vue'
import DashboardProjectsPage from './DashBoardPages/DashboardProjectsPage.vue'
import DashboardSearchProjects from './DashBoardPages/DashboardSearchProjects.vue'
import DashboardUserProfile from './DashBoardPages/DashboardUserProfile.vue'

// Import your components (assuming these pages are already created as Vue components)

export default defineComponent({
  name: 'DashboardPage',
  data () {
    return {
      // List of pages with file and name
      pages: [
        { file: 'DashboardMainPage', name: 'Main', component: DashboardMainPage },
        { file: 'DashboardMessagePage', name: 'Messages', component: DashboardMessagePage },
        { file: 'DashboardTaskPage', name: 'Tasks', component: DashboardTaskPage },
        { file: 'DashboardProjectsPage', name: 'Projects', component: DashboardProjectsPage },
        { file: 'DashboardSearchPage', name: 'Search', component: DashboardSearchProjects },
        { file: 'DashboardUserProfile', name: 'Profile', component: DashboardUserProfile }
      ],
      currentPage: 'DashboardMainPage' // Default to the first page (Main)
    }
  },
  methods: {
    // Method to handle logout
    logout () {
      localStorage.removeItem('auth_token')
      delete this.$axios.defaults.headers.common.Authorization
      this.$router.push({ name: 'HomePage' })
    },
    // Method to navigate to a page
    navigateTo (page) {
      // Update the currentPage to the selected page component
      this.currentPage = page.component
    }
  }
})
</script>

<style scoped>
.dashboard {
  position: relative;
  height: 100vh;
  width: 100%;
  /* background-color: #000000; */
}

.button-container {
  position: absolute;
  top: 30px;
  left: 30px;
  display: flex; /* Enables flexbox */
  flex-direction: row; /* Makes buttons align side by side */
  gap: 13px; /* Adds spacing between buttons */
}

.nav-button {
  width: 210px; /* Button width */
  height: 54px; /* Button height */
  padding: 10px;
  background-color: #ffffff;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  line-height: 34px; /* Aligns text vertically */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-weight: 300;
}

.nav-button:hover {
  background-color: #ececec;
}

.page-content {
  position: absolute;
  top: 90px; /* Make space for the nav */
  left: 30px;
  right: 30px;
  bottom: 50px; /* Adjust based on the logout button */
  overflow: auto;
  background: white;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.logout-button {
  position: absolute;
  bottom: 30px;
  right: 30px;
  padding: 10px 20px;
  background-color: #f44336;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.logout-button:hover {
  background-color: #e53935;
}
</style>
