import Vue from 'vue'
import Router from 'vue-router'
import Accounts from '@/components/Accounts'
import Orders from '@/components/Orders'

Vue.use(Router)

export default new Router({
  routes: [
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
})
