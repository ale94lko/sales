<template>
  <div class="edit-product">
    <div class="slds-clearfix">
      <div class="slds-float_left">
        <h3 class="slds-welcome-mat__tile-title">Add product</h3>
      </div>
    </div>
    <div class="slds-form-element" v-bind:class="[{ 'slds-has-error': localErrors.name }]">
      <label class="slds-form-element__label slds-float_left" for="form-element-01">
        Name
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a name"
          v-model="currentProduct.name"/>
      </div>
      <div class="slds-form-element__help" id="error-01" v-if="localErrors.name">
        {{ localErrors.name }}
      </div>
    </div>
    <div class="slds-form-element" v-bind:class="[{ 'slds-has-error': localErrors.price }]">
      <label class="slds-form-element__label slds-float_left" for="form-element-02">
        Price
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a price"
          v-model="currentProduct.price"/>
      </div>
      <div class="slds-form-element__help" id="error-01" v-if="localErrors.price">
        {{ localErrors.price }}
      </div>
    </div>
    <div class="slds-button-group-row submit" role="group">
      <button class="slds-button slds-button_brand"
        v-on:click.prevent="submitData()">
        Submit data
      </button>
      <button class="slds-button slds-button_neutral"
        v-on:click.prevent="cancel()">
        Cancel
      </button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapMutations } from 'vuex'
import router from '@/router'
import axios from 'axios'

export default {
  name: 'edit-product',
  data() {
    return {
      currentProduct: {
        id: null,
        name: null,
        price: null,
      },
      localErrors: {
        name: null,
        price: null,
      },
    }
  },
  methods: {
    ...mapMutations([
      'setErrors',
      'setShowModal',
      'setModal',
    ]),
    ...mapActions(['addProduct']),
    async submitData() {
      if (this.currentProduct.name.trim() === '') {
        this.localErrors.name = 'Product name cannot be blank'
      } else if (this.currentProduct.price.trim() === '') {
        this.localErrors.price = 'Product price cannot be blank'
      } else {
        this.cleanErrors()
        const { status, data } = await axios.post(
          'http://localhost:8080/api/product',
          this.currentProduct
        )
        if (status === 201) {
          await this.addProduct(data)
          let modal = {
            title: 'Successful Operation',
            message: 'Product successfully saved',
            confirmRoute: null,
            confirmMessage: 'Add another product',
            cancelRoute: 'products',
            cancelMessage: 'Go back',
          }
          this.cleanCurrentProduct()
          this.setModal(modal)
          this.setShowModal(true)
        }
      }
    },
    cancel() {
      router.push({ name: 'products' })
    },
    cleanErrors() {
      this.localErrors = {
        name: null
      }
    },
    cleanCurrentProduct() {
      this.currentProduct = {
        id: null,
        name: null,
        price: null,
      }
    },
  }
}
</script>

<style scoped>
  .submit {
    margin-top: 5px;
  }
</style>
