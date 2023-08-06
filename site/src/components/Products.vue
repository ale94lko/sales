<template>
  <div class="list slds-scrollable" tabindex="0">
    <table class="slds-table slds-table_cell-buffer slds-table_bordered">
      <thead>
      <tr class="slds-line-height_reset">
        <th class="" scope="col">
          <div class="slds-truncate" title="Name">
            Name
          </div>
        </th>
        <th class="" scope="col">
          <div class="slds-truncate" title="Price">
            Price
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
          <div class="slds-truncate action"
            v-on:click="deleteProduct(product.id)">
            Delete
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'products-component',
  computed: {
    ...mapState({
      productList: (state) => state.productList,
    }),
  },
  methods: {
    deleteProduct(productId) {
      console.log(productId)
    },
  }
}
</script>

