import { createStore } from 'vuex'

export default createStore({
  state: {
    errors: null,
    currentAccountId: null,
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
  },
})
