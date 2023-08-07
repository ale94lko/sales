import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home'
import Accounts from '@/components/Accounts'
import Products from '@/components/Products'
import Orders from '@/components/Orders'
import EditAccount from '@/components/EditAccount'

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
        path: 'products',
        name: 'products',
        component: Products,
      },
      {
        path: 'create-order',
        name: 'create-order',
        component: Orders,
      },
      {
        path: 'edit-account',
        name: 'edit-account',
        component: EditAccount,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
