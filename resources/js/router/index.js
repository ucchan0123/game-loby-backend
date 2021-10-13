import { createRouter, createWebHistory } from 'vue-router'
import Welcome from '../pages/Welcome.vue'

const routes = [
  {
    path: '/',
    name: 'Welcome',
    component: Welcome
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
