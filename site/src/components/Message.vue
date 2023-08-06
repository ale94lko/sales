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
                    <h2 class="slds-welcome-mat__tile-title"> Your order has been submitted successfully </h2>
                  </div>
                  <button class="slds-button slds-button_brand"
                    v-on:click.prevent="createAnotherOrder()">
                    Create Another Order
                  </button>
                  <button class="slds-button slds-button_neutral"
                    v-on:click.prevent="changeAccount()">
                    Change Account
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
import { mapState } from 'vuex'
import router from '@/router'

export default {
  name: 'message-component',
  computed: {
    ...mapState({
      accountId: (state) => state.currentAccountId,
    }),
  },
  methods: {
    createAnotherOrder() {
      router.push({ name: 'orders' })
    },
    changeAccount() {
      router.push({ name: 'accounts' })
    },
  }
}
</script>

<style scoped>

</style>
