<template>
  <div class="container">
    <div class="slds-clearfix">
      <div class="slds-float_right">
        <h3 class="slds-welcome-mat__tile-title">New Order</h3>
      </div>
    </div>
    <div class="cols">
      <div class="left-column">
        <div class="slds-form-element">
          <div class="slds-form-element__control slds-input-has-icon slds-input-has-icon_left search-box">
            <svg class="slds-icon slds-input__icon slds-input__icon_left slds-icon-text-default" aria-hidden="true">
              <use xlink:href="@/assets/icons/utility-sprite/svg/symbols.svg#search"></use>
            </svg>
            <input v-model="searchText" type="text" id="text-input-id-472" placeholder="Search Products" class="slds-input" />
          </div>
        </div>
        <div class="slds-scrollable_y" tabindex="0">
          <article class="slds-card" v-for="product of productsToSelect" :key="product.id">
            <div class="slds-card__header slds-grid">
              <header class="slds-media slds-media_center slds-has-flexi-truncate">
                <div class="slds-media__body">
                  <h2 class="slds-card__header-title">
                    <span>{{ product.name }}</span>
                  </h2>
                </div>
                <div class="slds-no-flex">
                  <button class="slds-button slds-button_neutral"
                    v-on:click="addProduct(product.id)">
                    <svg class="slds-button__icon slds-button__icon_left" aria-hidden="true">
                      <use xlink:href="@/assets/icons/utility-sprite/svg/symbols.svg#new"></use>
                    </svg>
                    Add
                  </button>
                </div>
              </header>
            </div>
            <div class="slds-card__body"></div>
            <footer class="slds-card__footer"></footer>
          </article>
        </div>
      </div>
      <div class="right-column">
        <div class="order-list" tabindex="0">
          <div class="list slds-scrollable" tabindex="0">
            <table class="slds-table slds-table_cell-buffer slds-table_bordered">
              <thead>
              <tr class="slds-line-height_reset">
                <th scope="col">
                  <div class="slds-truncate" title="Product">Product</div>
                </th>
                <th scope="col">
                  <div class="slds-truncate" title="Unit Price">Unit Price</div>
                </th>
                <th scope="col">
                  <div class="slds-truncate" title="Quantity">Qty</div>
                </th>
                <th scope="col">
                  <div class="slds-truncate" title="Total">Total</div>
                </th>
                <th scope="col">
                  <div class="slds-truncate" title="Actions">Actions</div>
                </th>
              </tr>
              </thead>
              <tbody>
              <tr class="slds-hint-parent" v-for="product of productOrder" :key="product.id">
                <th data-label="Product" scope="row">
                  <div class="slds-truncate">{{ product.name }}</div>
                </th>
                <td data-label="Unit Price">
                  <div class="slds-truncate">{{ product.price }}</div>
                </td>
                <td data-label="Quantity">
                  <div class="slds-truncate">
                    <input class="number" type="number" min="1" max="99"
                      v-model="product.qty"
                      v-on:input="calculateOrderSubtotal()"
                      v-on:keypress="keypressInputMask($event)"/>
                  </div>
                </td>
                <td data-label="Total">
                  <div class="slds-truncate">
                    {{ calculateProductTotal(product) }}
                  </div>
                </td>
                <td data-label="Actions">
                  <div class="slds-truncate action">
                    <span class="slds-icon_container" title="Delete">
                      <svg class="slds-icon slds-icon_x-small slds-icon-text-error"
                        aria-hidden="true"
                        v-on:click="deleteProduct(product.id)">
                        <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#delete"></use>
                      </svg>
                    </span>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="summary">
            <table class="slds-table slds-table_cell-buffer">
              <tbody>
              <tr class="slds-hint-parent">
                <th data-label="Subtotal" scope="row">
                  <div class="slds-truncate">Subtotal</div>
                </th>
                <td data-label="Subtotal Value">
                  <div class="slds-truncate">{{ orderSubtotalValue }}</div>
                </td>
              </tr>
              <tr class="slds-hint-parent">
                <th data-label="Taxes" scope="row">
                  <div class="slds-truncate">Taxes (7%)</div>
                </th>
                <td data-label="Taxes Value">
                  <div class="slds-truncate">{{ taxesValue }}</div>
                </td>
              </tr>
              <tr class="slds-hint-parent">
                <th data-label="Total" scope="row">
                  <div class="slds-truncate">
                    <h3 class="slds-welcome-mat__tile-title">Total</h3>
                  </div>
                </th>
                <td data-label="Total Value">
                  <div class="slds-truncate">{{ totalValue }}</div>
                </td>
              </tr>
              </tbody>
            </table>
            <div class="slds-button-group-row submit" role="group">
              <button class="slds-button slds-button_brand"
                v-on:click.prevent="submitOrder()">
                Submit Order
              </button>
              <button class="slds-button slds-button_neutral"
                v-on:click.prevent="cancelOrder()">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
import router from '@/router'

export default {
  name: 'orders-component',
  data () {
    return {
      selectedProducts: [],
      productOrder: [],
      orderSubtotal: 0,
      searchText: '',
    }
  },
  mounted() {
    if (this.accountId === null) {
      this.setErrors('Please select an account to create order')
      let cleanErrors = setInterval(() => {
        this.setErrors(null)
        clearInterval(cleanErrors)
      }, 5000)
      router.push({ name: 'accounts' })
    }
  },
  computed: {
    ...mapState({
      errors: (state) => state.errors,
      productList: (state) => state.productList,
      accountId: (state) => state.currentAccountId,
    }),
    productsToSelect() {
      return this.productList.filter((product) => {
        return !this.selectedProducts.includes(product.id) &&
          product.name.includes(this.searchText.trim())
      })
    },
    orderSubtotalValue() {
      return '$' + this.orderSubtotal.toFixed(2)
    },
    taxesValue() {
      return '$' + (this.orderSubtotal * 0.07).toFixed(2)
    },
    totalValue() {
      return '$' + (this.orderSubtotal + this.orderSubtotal * 0.07).toFixed(2)
    }
  },
  methods: {
    ...mapMutations([
      'setErrors',
      'setShowModal',
      'setModal',
    ]),
    addProduct(id) {
      this.selectedProducts.push(id)
      let product = this.productList.find((product) => {
        return product.id === id
      })
      product.qty = 1

      this.productOrder.push(product)
      this.calculateOrderSubtotal()
    },
    deleteProduct(id) {
      let index = this.selectedProducts.findIndex((productId) => {
        return productId === id
      })
      if (index !== -1) {
        this.selectedProducts.splice(index, 1)
      }

      let orderIndex = this.productOrder.findIndex((product) => {
        return product.id === id
      })
      if (orderIndex !== -1) {
        this.productOrder.splice(orderIndex, 1)
      }

      this.calculateOrderSubtotal()
    },
    calculateOrderSubtotal() {
      let subtotal = 0
      for (let product of Object.values(this.productOrder)) {
        subtotal += parseFloat(product.price * product.qty)
      }

      this.orderSubtotal = subtotal
    },
    calculateProductTotal(product) {
      return (product.price * product.qty).toFixed(2)
    },
    async submitOrder() {
      if (this.productOrder.length === 0) {
        let error = 'Order cannot be empty. Please select at least one product.'
        this.setErrors(error)
        let cleanErrors = setInterval(() => {
          this.setErrors(null)
          clearInterval(cleanErrors)
        }, 5000)
      } else {
        try {
          let order = {
            account_id: this.accountId,
            subtotal: this.orderSubtotal,
            taxes: this.taxesValue.replace('$', ''),
            total: this.totalValue.replace('$', ''),
            productOrderList: this.productOrder
          }
          const { status } = await axios.post(
            'http://localhost:8080/api/order/insert', order
          )
          if (status === 201) {
            let modal = {
              title: 'Successful Operation',
              message: 'Your order has been submitted successfully',
              confirmRoute: null,
              confirmMessage: 'Create Another Order',
              cancelRoute: 'accounts',
              cancelMessage: 'Change Account',
            }
            this.setModal(modal)
            this.setShowModal(true)
            this.cleanProducts()
          }
        } catch (e) {
          this.setErrors(e)
          let cleanErrors = setInterval(() => {
            this.cleanErrors()
            clearInterval(cleanErrors)
          }, 5000)
        }
      }
    },
    cancelOrder() {
      router.push({ name: 'accounts' })
    },
    keypressInputMask(e) {
      if (e.keyCode < 48 || e.keyCode > 58) {
        e.preventDefault()
      }
      if (e.target.value.length > 1) {
        e.preventDefault()
      }
    },
    cleanProducts() {
      this.selectedProducts = []
      this.productOrder = []
    },
    cleanErrors() {
      this.setErrors(null)
    }
  }
}
</script>

<style scoped>
  .container {
    display: flex;
    flex-direction: column;
  }

  .cols {
    display: flex;
    flex-direction: row;
  }

  .slds-clearfix {
    margin-top: 20px;
  }

  .search-box {
    margin-bottom: 10px;
  }

  .order-list {
    padding-top: 12px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .list {
    height:17rem;
    width:22rem;
  }

  .left-column {
    padding: 10px;
  }

  .right-column {
    max-width: 600px;
  }

  .summary {
    display: flex;
    flex-direction: column;
  }

  .submit {
    margin-top: 5px;
    display: flex;
    justify-content: end;
  }

  .slds-icon {
    cursor: pointer;
  }

  .number {
    max-width: 25px;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  input[type=number] {
    -moz-appearance: textfield;
  }

  .slds-card {
    margin-top: unset;
  }

  .slds-grid {
    padding-top: unset;
  }

  .slds-card__header {
    margin-bottom: 0.20rem;
    padding-right: 0;
  }

  .slds-scrollable_y {
    height:22rem;
  }
</style>
