import { createRouter, createWebHistory } from 'vue-router'
import Accounts from '@/components/Accounts'
import Orders from '@/components/Orders'

const routes = [
  {
    path: '/',
    name: 'accounts',
    component: Accounts
  },
  {
    path: '/orders/:accountId',
    name: 'orders',
    component: Orders
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
