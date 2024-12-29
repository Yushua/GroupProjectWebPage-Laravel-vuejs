import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Ensure the app is created and mounted only once
const app = createApp(App)
app.use(router)
app.mount('#app')
