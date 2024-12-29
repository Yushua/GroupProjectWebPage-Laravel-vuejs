import { createRouter, createWebHistory } from 'vue-router'
import DashboardPage from '../views/Dashboard/DashboardPage.vue'
import NewLogin from '../views/HomePage/NewLogin.vue'
const routes = [
  {
    path: '/',
    name: 'NewLogin',
    component: NewLogin
  },
  {
    path: '/dashboard',
    name: 'DashboardPage',
    component: DashboardPage
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
