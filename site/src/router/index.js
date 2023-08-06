import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home'
import Accounts from '@/components/Accounts'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    children: [
      {
        path: 'accounts',
        name: 'accounts',
        component: Accounts,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
