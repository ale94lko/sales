<template>
  <div class="edit-account">
    <div class="slds-clearfix">
      <div class="slds-float_left">
        <h3 class="slds-welcome-mat__tile-title">Edit account</h3>
      </div>
    </div>
    <div class="slds-form-element" v-bind:class="[{ 'slds-has-error': localErrors.name }]">
      <label class="slds-form-element__label slds-float_left" for="form-element-01">
        Name
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a name"
          v-model="currentAccount.name"/>
      </div>
      <div class="slds-form-element__help" id="error-01" v-if="localErrors.name">
        {{ localErrors.name }}
      </div>
    </div>
    <div class="slds-form-element">
      <label class="slds-form-element__label slds-float_left" for="form-element-02">
        Phone number
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a phone number"
          v-model="currentAccount.phone"/>
      </div>
    </div>
    <div class="slds-form-element">
      <label class="slds-form-element__label slds-float_left" for="form-element-03">
        Street
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a street"
          v-model="currentAccount.street"/>
      </div>
    </div>
    <div class="slds-form-element">
      <label class="slds-form-element__label slds-float_left" for="form-element-04">
        City
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a city"
          v-model="currentAccount.city"/>
      </div>
    </div>
    <div class="slds-form-element">
      <label class="slds-form-element__label slds-float_left" for="form-element-05">
        State
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a state"
          v-model="currentAccount.state"/>
      </div>
    </div>
    <div class="slds-form-element">
      <label class="slds-form-element__label slds-float_left" for="form-element-06">
        Postal code
      </label>
      <div class="slds-form-element__control">
        <input type="text" id="form-element-01" class="slds-input"
          placeholder="Enter a postal code"
          v-model="currentAccount.postal_code"/>
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
import { mapActions, mapMutations, mapState } from 'vuex'
import router from '@/router'
import axios from 'axios'

export default {
  name: 'edit-account',
  data() {
    return {
      currentAccount: {
        id: null,
        name: null,
        phone: null,
        street: null,
        city: null,
        state: null,
        postal_code: null,
      },
      localErrors: {
        name: null,
      },
    }
  },
  computed: {
    ...mapState({
      accountId: (state) => state.currentAccountId,
      accountList: (state) => state.accountList,
    }),
  },
  mounted() {
    if (this.accountId === null) {
      this.setErrors('Please select an account to edit')
      let cleanErrors = setInterval(() => {
        this.setErrors(null)
        clearInterval(cleanErrors)
      }, 5000)
      router.push({ name: 'accounts' })
    } else {
      this.currentAccount = {
        ...this.accountList.find((account) => {
          return account.id === this.accountId
        })
      }
    }
  },
  methods: {
    ...mapMutations([
      'setErrors',
      'setShowModal',
      'setModal',
    ]),
    ...mapActions(['editAccount']),
    async submitData() {
      if (this.currentAccount.name.trim() === '') {
        this.localErrors.name = 'Account name cannot be blank'
      } else {
        this.cleanErrors()
        const { status, data } = await axios.put(
          'http://localhost:8080/api/account/' + encodeURIComponent(this.accountId),
          this.currentAccount
        )
        if (status === 200) {
          await this.editAccount(data)
          let modal = {
            title: 'Successful Operation',
            message: 'Account successfully saved',
            confirmRoute: null,
            confirmMessage: 'Continue editing account',
            cancelRoute: 'accounts',
            cancelMessage: 'Change Account',
          }
          this.setModal(modal)
          this.setShowModal(true)
        }
      }
    },
    cancel() {
      router.push({ name: 'accounts' })
    },
    cleanErrors() {
      this.localErrors = {
        name: null
      }
    }
  }
}
</script>

<style scoped>
  .submit {
    margin-top: 5px;
  }
</style>
