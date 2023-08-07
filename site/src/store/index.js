import { createStore } from 'vuex'

export default createStore({
  state: {
    errors: null,
    currentAccountId: null,
    currentProductId: null,
    showModal: false,
    modal: {
      title: null,
      message: null,
      confirmRoute: null,
      confirmMessage: null,
      cancelRoute: null,
      cancelMessage: null,
    },
    accountList: [],
    productList: [],
  },
  mutations: {
    setErrors(state, data) {
      state.errors = data
    },
    setCurrentAccountId(state, data) {
      state.currentAccountId = data
    },
    setCurrentProductId(state, data) {
      state.currentProductId = data
    },
    setShowModal(state, data) {
      state.showModal = data
    },
    setModal(state, data) {
      state.modal = data
    },
    setAccountList(state, data) {
      state.accountList = data
    },
    setProductList(state, data) {
      state.productList = data
    },
  },
  actions: {
    deleteProduct({ commit, state }, productId) {
      let index = state.productList.findIndex((product) => {
        return product.id === productId
      })

      if (index !== -1) {
        let tempProducts = state.productList
        tempProducts.splice(index, 1)
        commit('setProductList', tempProducts)
      } else {
        let err = 'The product you are trying to delete does not longer exist'
        commit('setErrors', err)
      }
    },
    deleteAccount({ commit, state }, accountId) {
      let index = state.accountList.findIndex((account) => {
        return account.id === accountId
      })

      if (index !== -1) {
        let tempAccounts = state.accountList
        tempAccounts.splice(index, 1)
        commit('setAccountList', tempAccounts)
      } else {
        let err = 'The account you are trying to delete does not longer exist'
        commit('setErrors', err)
      }
    },
    editAccount({ commit, state }, data) {
      let index = state.accountList.findIndex((account) => {
        return account.id === data.id
      })

      if (index !== -1) {
        let tempAccounts = state.accountList
        tempAccounts.splice(index, 1, data)
        commit('setAccountList', tempAccounts)
      } else {
        let err = 'The account you are trying to edit does not longer exist'
        commit('setErrors', err)
      }
    },
    addAccount({ commit, state }, data) {
      let tempAccounts = state.accountList
      tempAccounts.push(data)
      commit('setAccountList', tempAccounts)
    },
    editProduct({ commit, state }, data) {
      let index = state.productList.findIndex((product) => {
        return product.id === data.id
      })

      if (index !== -1) {
        let tempProducts = state.productList
        tempProducts.splice(index, 1, data)
        commit('setProductList', tempProducts)
      } else {
        let err = 'The product you are trying to edit does not longer exist'
        commit('setErrors', err)
      }
    },
    addProduct({ commit, state }, data) {
      let tempProducts = state.productList
      tempProducts.push(data)
      commit('setProductList', tempProducts)
    },
  },
})
