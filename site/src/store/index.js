import { createStore } from 'vuex'

export default createStore({
  state: {
    currentAccountId: null,
    accountList: [],
    productList: [],
  },
  mutations: {
    setCurrentAccountId(state, data) {
      state.currentAccountId = data
    },
    setAccountList(state, data) {
      state.accountList = data
    },
    setProductList(state, data) {
      state.productList = data
    },
  },
  actions: {},
})
