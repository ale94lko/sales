import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home'
import Accounts from '@/components/Accounts'
import Orders from '@/components/Orders'

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
      {
        path: 'create-order',
        name: 'create-order',
        component: Orders,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
