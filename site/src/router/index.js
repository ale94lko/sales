import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home'
import Accounts from '@/components/Accounts'
import Products from '@/components/Products'
import Orders from '@/components/Orders'
import EditAccount from '@/components/EditAccount'
import AddAccount from '@/components/AddAccount'
import EditProduct from '@/components/EditProduct'
import AddProduct from '@/components/AddProduct'

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
        path: 'add-account',
        name: 'add-account',
        component: AddAccount,
      },
      {
        path: 'edit-account',
        name: 'edit-account',
        component: EditAccount,
      },
      {
        path: 'create-order',
        name: 'create-order',
        component: Orders,
      },
      {
        path: 'products',
        name: 'products',
        component: Products,
      },
      {
        path: 'add-product',
        name: 'add-product',
        component: AddProduct,
      },
      {
        path: 'edit-product',
        name: 'edit-product',
        component: EditProduct,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
