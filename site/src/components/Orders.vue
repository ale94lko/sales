<template>
  <div class="create-order">
    <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="welcome-mat-596-label" class="slds-modal slds-fade-in-open slds-modal_small">
      <div class="slds-modal__container">
        <div class="slds-modal__header slds-modal__header_empty"></div>
        <div class="slds-modal__content" id="welcome-mat-596-content">
          <div class="slds-welcome-mat slds-welcome-mat_splash">
            <div class="slds-welcome-mat__content slds-grid">
              <div class="slds-welcome-mat__info slds-size_1-of-1 content" tabindex="0" role="region">
                <div class="container">
                  <div class="slds-notify_container slds-is-relative" v-if="errors">
                    <div class="slds-notify slds-notify_toast slds-theme_error" role="status">
                      <span class="slds-assistive-text">error</span>
                      <div class="slds-notify__content">
                        <h2 class="slds-text-heading_small">{{ errors }}</h2>
                      </div>
                    </div>
                  </div>
                  <div class="slds-clearfix">
                    <div class="slds-float_right">
                      <h3 class="slds-welcome-mat__tile-title">New Order</h3>
                    </div>
                  </div>
                  <div class="cols">
                    <div class="left-column">
                      <div class="slds-form-element">
                        <div class="slds-form-element__control slds-input-has-icon slds-input-has-icon_left search-box">
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
                              <th class="" scope="col">
                                <div class="slds-truncate" title="Product">
                                  Product
                                </div>
                              </th>
                              <th class="" scope="col">
                                <div class="slds-truncate" title="Unit Price">
                                  Unit Price
                                </div>
                              </th>
                              <th class="" scope="col">
                                <div class="slds-truncate" title="Quantity">
                                  Qty
                                </div>
                              </th>
                              <th class="" scope="col">
                                <div class="slds-truncate" title="Total">
                                  Total
                                </div>
                              </th>
                              <th class="" scope="col">
                                <div class="slds-truncate" title="Actions">
                                  Actions
                                </div>
                              </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="slds-hint-parent" v-for="product of productOrder" :key="product.id">
                              <th data-label="Product" scope="row">
                                <div class="slds-truncate">
                                  {{ product.name }}
                                </div>
                              </th>
                              <td data-label="Unit Price">
                                <div class="slds-truncate">
                                  {{ product.price }}
                                </div>
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
                                <div class="slds-truncate action"
                                  v-on:click="deleteProduct(product.id)">
                                  Delete
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
                                <div class="slds-truncate">
                                  Subtotal
                                </div>
                              </th>
                              <td data-label="Subtotal Value">
                                <div class="slds-truncate">
                                  {{ orderSubtotalValue }}
                                </div>
                              </td>
                            </tr>
                            <tr class="slds-hint-parent">
                              <th data-label="Taxes" scope="row">
                                <div class="slds-truncate">Taxes (7%)</div>
                              </th>
                              <td data-label="Taxes Value">
                                <div class="slds-truncate">
                                  {{ taxesValue }}
                                </div>
                              </td>
                            </tr>
                            <tr class="slds-hint-parent">
                              <th data-label="Total" scope="row">
                                <div class="slds-truncate">
                                  <h3 class="slds-welcome-mat__tile-title">
                                    Total
                                  </h3>
                                </div>
                              </th>
                              <td data-label="Total Value">
                                <div class="slds-truncate">
                                  {{ totalValue }}
                                </div>
                              </td>
                            </tr>
                            </tbody>
                          </table>
                          <div class="slds-button-group-row submit" role="group">
                            <button class="slds-button slds-button_brand"
                              v-on:click.prevent="submitOrder">
                              Submit Order
                            </button>
                            <button class="slds-button slds-button_neutral"
                              v-on:click.prevent="cancelOrder">
                              Cancel
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="slds-backdrop slds-backdrop_open" role="presentation"></div>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
import router from '../router'

export default {
  name: 'orders-component',
  data () {
    return {
      selectedProducts: [],
      productOrder: [],
      orderSubtotal: 0,
      searchText: '',
      errors: null
    }
  },
  async mounted () {
    if (this.productList.length === 0) {
      try {
        const {status, data} = await axios.get(
          'http://localhost:8080/api/product'
        )
        if (status === 200) {
          this.setProductList(data)
        }
      } catch (e) {
        this.errors = e
      }
    }
  },
  computed: {
    ...mapState({
      productList: (state) => state.productList,
      accountId: (state) => state.currentAccountId,
    }),
    productsToSelect () {
      return this.productList.filter((product) => {
        return !this.selectedProducts.includes(product.id) &&
          product.name.includes(this.searchText.trim())
      })
    },
    orderSubtotalValue () {
      return '$' + this.orderSubtotal.toFixed(2)
    },
    taxesValue () {
      return '$' + (this.orderSubtotal * 0.07).toFixed(2)
    },
    totalValue () {
      return '$' + (this.orderSubtotal + this.orderSubtotal * 0.07).toFixed(2)
    }
  },
  methods: {
    ...mapMutations(['setProductList']),
    addProduct (id) {
      this.selectedProducts.push(id)
      let product = this.productList.find((product) => {
        return product.id === id
      })
      product.qty = 1

      this.productOrder.push(product)
      this.calculateOrderSubtotal()
    },
    deleteProduct (id) {
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
    calculateOrderSubtotal () {
      let subtotal = 0
      for (let product of Object.values(this.productOrder)) {
        subtotal += parseFloat(product.price * product.qty)
      }

      this.orderSubtotal = subtotal
    },
    calculateProductTotal (product) {
      return (product.price * product.qty).toFixed(2)
    },
    async submitOrder () {
      if (this.productOrder.length === 0) {
        this.errors =
            'Order cannot be empty. Please select at least one product.'
        let cleanErrors = setInterval(() => {
          this.errors = null
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
            router.push({ name: 'accounts' })
          }
        } catch (e) {
          this.errors = e
          let cleanErrors = setInterval(() => {
            this.errors = null
            clearInterval(cleanErrors)
          }, 5000)
        }
      }
    },
    cancelOrder () {
      router.push({ name: 'accounts' })
    },
    keypressInputMask (e) {
      if (e.keyCode < 48 || e.keyCode > 58) {
        e.preventDefault()
      }
      if (e.target.value.length > 1) {
        e.preventDefault()
      }
    },
    cleanErrors () {
      this.errors = null
    }
  }
}
</script>

<style scoped>
  .content {
    position: fixed;
  }

  .container {
    display: flex;
    flex-direction: column;
    min-width: 730px;
    margin-top: 20px;
  }

  .cols {
    display: flex;
    flex-direction: row;
  }

  .slds-clearfix {
    margin-top: 20px;
  }

  .search-box {
    margin-bottom: 20px;
  }

  .order-list {
    padding-top: 12px;
    margin-left: 60px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .list {
    height:20rem;
    width:20rem;
  }

  .left-column {
    border: 2px solid #4d5154;
    border-radius: 7px;
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

  .action {
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
    margin-bottom: 0.50rem;
    padding-right: 0;
  }

  .slds-scrollable_y {
    height:25rem;
    width:20rem;
  }
</style>
