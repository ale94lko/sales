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
                      <div class="slds-scrollable_y order-list" tabindex="0">
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
import { mapState } from 'vuex'
import axios from 'axios'

export default {
  name: 'order',
  data () {
    return {
      products: [],
      selectedProducts: [],
      searchText: '',
      errors: null
    }
  },
  async mounted () {
    console.log(this.$route.params.accountId)
    try {
      const { status, data } = await axios.get(
        'http://localhost:8080/api/product'
      )
      if (status === 200) {
        this.products = data
      }
    } catch (e) {
      this.errors = e
    }
  },
  computed: {
    ...mapState({
      currentAccount: (store) => store.currentAccount
    }),
    productsToSelect () {
      return this.products.filter((product) => {
        return !this.selectedProducts.includes(product.id) &&
          product.name.includes(this.searchText)
      })
    }
  },
  methods: {
    addProduct (id) {
      this.selectedProducts.push(id)
      console.log(this.currentAccount)
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
    margin-left: 70px;
  }

  .left-column {
    border: 2px solid #4d5154;
    border-radius: 7px;
    padding: 10px;
  }

  .slds-card {
    margin-top: unset;
  }

  .slds-grid {
    padding-top: unset;
  }

  .slds-card__header {
    margin-bottom: 0.50rem;
  }

  .slds-scrollable_y {
    height:25rem;
    width:20rem;
  }
</style>
