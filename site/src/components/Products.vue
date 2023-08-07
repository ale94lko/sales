<template>
  <div class="list slds-scrollable" tabindex="0">
    <table class="slds-table slds-table_cell-buffer slds-table_bordered">
      <thead>
      <tr class="slds-line-height_reset">
        <th scope="col">
          <div class="slds-truncate" title="Name">
            Name
          </div>
        </th>
        <th scope="col">
          <div class="slds-truncate" title="Price">
            Price
          </div>
        </th>
        <th scope="col">
          <div class="slds-truncate" title="Actions">
            Actions
          </div>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr class="slds-hint-parent" v-for="product of productList" :key="product.id">
        <th data-label="Name" scope="row">
          <div class="slds-truncate">
            {{ product.name }}
          </div>
        </th>
        <td data-label="Phone">
          <div class="slds-truncate">
            {{ product.price }}
          </div>
        </td>
        <td data-label="Actions">
          <div class="slds-truncate action">
            <span class="slds-icon_container" title="Edit account">
              <svg class="slds-icon slds-icon_x-small slds-icon-text-default"
                aria-hidden="true"
                v-on:click="editProduct(product.id)">
                <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#edit"></use>
              </svg>
            </span>
            <span class="slds-icon_container" title="Delete">
              <svg class="slds-icon slds-icon_x-small slds-icon-text-error"
                aria-hidden="true"
                v-on:click="removeProduct(product.id)">
                <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#delete"></use>
              </svg>
            </span>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapMutations, mapState, mapActions } from 'vuex'
import axios from 'axios'
import router from "@/router";

export default {
  name: 'products-component',
  computed: {
    ...mapState({
      productList: (state) => state.productList,
    }),
  },
  methods: {
    ...mapMutations(['setErrors', 'setCurrentProductId']),
    ...mapActions(['deleteProduct']),
    editProduct(productId) {
      this.setCurrentProductId(productId)
      router.push({ name: 'edit-product' })
    },
    async removeProduct(productId) {
      try {
        const { status } = await axios.delete(
          'http://localhost:8080/api/product/' + productId
        )
        if (status === 204) {
          await this.deleteProduct(productId)
        }
      } catch (e) {
        this.setErrors(e)
        let cleanErrors = setInterval(() => {
          this.setErrors(null)
          clearInterval(cleanErrors)
        }, 5000)
      }
    },
  }
}
</script>

<style scoped>
  .slds-icon {
    cursor: pointer;
    margin-right: 5px;
  }
</style>
