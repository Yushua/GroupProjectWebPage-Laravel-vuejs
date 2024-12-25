import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage/HomePage.vue'
import LoginPage from '../views/HomePage/LoginPage.vue'
import RegisterPage from '../views/HomePage/RegisterPage.vue'
import DashboardPage from '../views/Dashboard/DashboardPage.vue'

const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage
  },
  {
    path: '/register',
    name: 'RegisterPage',
    component: RegisterPage
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
