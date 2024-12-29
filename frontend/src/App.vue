<template>
  <router-view></router-view> <!-- Your routing component -->
</template>

<script>
import { checkToken } from '@/services/authService'

export default {
  name: 'App',
  created () {
    checkToken()
  }
}
</script>
