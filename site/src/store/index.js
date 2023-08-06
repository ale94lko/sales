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
  actions: {},
})
