<template>
  <div class="dashboard">
    <nav class="button-container">
      <button
        v-for="page in pages"
        :key="page.file"
        @click="navigateTo(page)"
        class="nav-button"
      >
        {{ page.name }}
      </button>
    </nav>
    <div class="page-content">
      <component :is="currentPage"></component>
    </div>
    <button @click="logout" class="logout-button">Logout</button>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import DashboardMainPage from './DashBoardPages/DashboardMainPage.vue'
import DashboardProjectsPage from './DashBoardPages/DashboardProjectsPage.vue'
import DashboardSearchProjects from './DashBoardPages/DashboardSearchProjects.vue'
import DashboardUserProfile from './DashBoardPages/DashboardUserProfile.vue'

export default defineComponent({
  name: 'DashboardPage',
  data () {
    return {
      pages: [
        { file: 'DashboardMainPage', name: 'Main', component: DashboardMainPage },
        { file: 'DashboardProjectsPage', name: 'Projects', component: DashboardProjectsPage },
        { file: 'DashboardSearchPage', name: 'Search', component: DashboardSearchProjects },
        { file: 'DashboardUserProfile', name: 'Profile', component: DashboardUserProfile }
      ],
      currentPage: 'DashboardMainPage'
    }
  },
  methods: {
    logout () {
      localStorage.removeItem('auth_token')
      delete this.$axios.defaults.headers.common.Authorization
      this.$router.push({ name: 'HomePage' })
    },
    navigateTo (page) {
      this.currentPage = page.component
    }
  }
})
</script>

<style scoped>
.dashboard {
  position: relative;
  height: 110vh;
  width: 100%;
}

.button-container {
  position: absolute;
  top: 30px;
  left: 30px;
  display: flex;
  flex-direction: row;
  gap: 13px;
}

.nav-button {
  width: 210px;
  height: 54px;
  padding: 10px;
  background-color: #ffffff;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  line-height: 34px;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-weight: 300;
}

.nav-button:hover {
  background-color: #ececec;
}

.page-content {
  position: absolute;
  top: 90px;
  left: 30px;
  right: 30px;
  bottom: 50px;
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
