<template>
  <div class="account">
    <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="welcome-mat-596-label" class="slds-modal slds-fade-in-open slds-modal_small">
      <div class="slds-modal__container">
        <div class="slds-modal__header slds-modal__header_empty"></div>
        <div class="slds-modal__content" id="welcome-mat-596-content">
          <div class="slds-welcome-mat slds-welcome-mat_splash">
            <div class="slds-welcome-mat__content slds-grid">
              <div class="slds-welcome-mat__info slds-size_1-of-1" tabindex="0" role="region">
                <div class="slds-welcome-mat__info-content">
                  <div class="slds-form-element" v-bind:class="[{ 'slds-has-error': errors }]">
                    <label class="slds-form-element__label" for="select-01">
                      <abbr class="slds-required" title="required">* </abbr>
                      Select Account
                    </label>
                    <div class="slds-form-element__control">
                      <div class="slds-select_container">
                        <select class="slds-select" id="select-01" required=""
                          v-model="selectedAccount"
                          v-on:change="cleanErrors">
                          <option value="">Select…</option>
                          <option v-for="account of accounts" :key="account.id"
                            v-bind:value="account.id"
                            v-text="account.name">
                          </option>
                      </select>
                      </div>
                    </div>
                    <div class="slds-form-element__help" id="error-01" v-if="errors">
                      {{ errors }}
                    </div>
                  </div>
                  <button class="slds-button slds-button_neutral"
                    v-on:click.prevent="createOrder">
                    Create Order
                  </button>
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
import axios from 'axios'
import router from '../router'

export default {
  name: 'accounts-component',
  data () {
    return {
      accounts: [],
      selectedAccount: null,
      errors: null
    }
  },
  async mounted () {
    try {
      const { status, data } = await axios.get(
        'http://localhost:8080/api/account'
      )
      if (status === 200) {
        this.accounts = data
      }
    } catch (e) {
      this.errors = e
    }
  },
  methods: {
    createOrder () {
      if (!this.selectedAccount) {
        this.errors = 'Account cannot be blank'
      } else {
        this.cleanErrors()
        router.push({
          name: 'orders',
          params: { accountId: this.selectedAccount }
        })
      }
    },
    cleanErrors () {
      this.errors = null
    }
  }
}
</script>

<style scoped>
  select {
    min-width: 200px;
  }

  button {
    margin-top: 20px;
  }
</style>
