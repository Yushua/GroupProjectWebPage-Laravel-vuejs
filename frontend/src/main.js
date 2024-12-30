import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from './axios'

const app = createApp(App)

// Use the router instance
app.use(router)

// Set axios on global properties. This ensures you can access axios via this.$axios in your components.
app.config.globalProperties.$axios = axios

// Mount the Vue app to the DOM element with id "app"
app.mount('#app')
