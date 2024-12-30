import { createRouter, createWebHistory } from 'vue-router'
import DashboardPage from '../views/Dashboard/DashboardPage.vue'
import HomePage from '@/views/HomePage/HomePage.vue'

const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: HomePage
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
