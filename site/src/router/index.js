import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home'
import Accounts from '@/components/Accounts'
import Orders from '@/components/Orders'
import Message from '@/components/Message'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/accounts',
    name: 'accounts',
    component: Accounts,
  },
  {
    path: '/orders',
    name: 'orders',
    component: Orders,
  },
  {
    path: '/message',
    name: 'message',
    component: Message,
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
