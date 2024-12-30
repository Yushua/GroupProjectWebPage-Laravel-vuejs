import { createRouter, createWebHistory } from 'vue-router'
import authService from '@/services/authService'
import NewLogin from '@/views/HomePage/NewLogin.vue'
import DashboardPage from '@/views/Dashboard/DashboardPage.vue'

// Define routes
const routes = [
  { path: '/', name: 'NewLogin', component: NewLogin },
  {
    path: '/dashboard',
    name: 'DashboardPage',
    component: DashboardPage
  }
]

// Create router instance
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// Global navigation guard to check token validity before routing
router.beforeEach(async (to, from, next) => {
  // If navigating to the login page and already logged in, redirect to dashboard
  if (to.name === 'NewLogin' && localStorage.getItem('auth_token')) {
    next({ name: 'DashboardPage' })
    return
  }

  // Check token validity for protected routes
  if (to.name === 'DashboardPage') {
    const isValidToken = await authService.checkToken()
    if (!isValidToken) {
      next({ name: 'NewLogin' }) // Redirect to login if token is invalid
      return
    }
  }

  next() // Allow navigation
})

export default router
