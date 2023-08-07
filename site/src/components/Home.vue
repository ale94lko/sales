<template>
  <div class="home">
    <section
      role="dialog"
      tabindex="-1"
      aria-modal="true"
      aria-labelledby="welcome-mat-596-label"
      class="slds-modal slds-fade-in-open slds-modal_small">
      <div class="slds-modal__container">
        <div class="slds-modal__header slds-modal__header_empty"></div>
        <div class="slds-modal__content" id="welcome-mat-596-content">
          <div class="slds-welcome-mat slds-welcome-mat_splash">
            <div class="slds-context-bar">
              <div class="slds-context-bar__primary">
                <div class="slds-context-bar__item slds-context-bar__dropdown-trigger slds-dropdown-trigger slds-dropdown-trigger_click slds-no-hover">
                  <div class="slds-context-bar__icon-action">
                    <button class="slds-button slds-icon-waffle_container slds-context-bar__button" title="Home">
                      <router-link to="/">
                        <span class="slds-icon-waffle">
                          <span class="slds-r1"></span>
                          <span class="slds-r2"></span>
                          <span class="slds-r3"></span>
                          <span class="slds-r4"></span>
                          <span class="slds-r5"></span>
                          <span class="slds-r6"></span>
                          <span class="slds-r7"></span>
                          <span class="slds-r8"></span>
                          <span class="slds-r9"></span>
                        </span>
                      </router-link>
                    </button>
                  </div>
                  <span class="slds-context-bar__label-action slds-context-bar__app-name">
                    <span class="slds-truncate" title="Sales">Sales</span>
                  </span>
                </div>
              </div>
              <nav class="slds-context-bar__secondary" role="navigation">
                <ul class="slds-grid">
                  <li v-bind:class="[
                      'slds-context-bar__item',
                      { 'slds-is-active': isActiveLink('home') },
                    ]">
                    <router-link to="/" class="slds-context-bar__label-action">
                      <span class="slds-indicator-container"></span>
                      <span class="slds-icon_container" title="Home">
                        <svg class="slds-icon slds-icon_small slds-icon-text-default" aria-hidden="true">
                          <use xlink:href="@/assets/icons/standard-sprite/svg/symbols.svg#home"></use>
                        </svg>
                        <span class="slds-assistive-text">Home</span>
                      </span>
                      <span class="slds-truncate" title="Home">Home</span>
                    </router-link>
                  </li>
                  <li v-bind:class="[
                      'slds-context-bar__item',
                      { 'slds-is-active': isActiveLink('accounts') },
                    ]">
                    <router-link to="/accounts" class="slds-context-bar__label-action">
                      <span class="slds-indicator-container"></span>
                      <span class="slds-icon_container" title="Accounts">
                        <svg class="slds-icon slds-icon_small slds-icon-text-default" aria-hidden="true">
                          <use xlink:href="@/assets/icons/standard-sprite/svg/symbols.svg#user"></use>
                        </svg>
                        <span class="slds-assistive-text">Accounts</span>
                      </span>
                      <span class="slds-truncate" title="Home">Accounts</span>
                    </router-link>
                  </li>
                  <li v-bind:class="[
                      'slds-context-bar__item',
                      { 'slds-is-active': isActiveLink('products') },
                    ]">
                    <router-link to="/products" class="slds-context-bar__label-action">
                      <span class="slds-indicator-container"></span>
                      <span class="slds-icon_container" title="Products">
                        <svg class="slds-icon slds-icon_small slds-icon-text-default" aria-hidden="true">
                          <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#description"></use>
                        </svg>
                        <span class="slds-assistive-text">Products</span>
                      </span>
                      <span class="slds-truncate" title="Home">Products</span>
                    </router-link>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="slds-welcome-mat__content slds-grid">
              <div class="slds-welcome-mat__info slds-size_1-of-1"
                 tabindex="0"
                 role="region">
                <div class="slds-welcome-mat__info-content">
                  <div class="modal" v-if="showModal">
                    <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="modal-heading-01" class="slds-modal slds-fade-in-open">
                      <div class="slds-modal__container">
                        <div class="slds-modal__header">
                          <h1 id="modal-heading-01" class="slds-modal__title slds-hyphenate">{{ modal.title }}</h1>
                        </div>
                        <div class="slds-modal__content slds-p-around_medium" id="modal-content-id-1">
                          {{ modal.message }}
                        </div>
                        <div class="slds-modal__footer">
                          <button class="slds-button slds-button_brand"
                            aria-label="Cancel and close"
                            v-on:click="confirmModal()">
                            {{ modal.confirmMessage }}
                          </button>
                          <button class="slds-button slds-button_neutral"
                            v-on:click="cancelModal()">
                            {{ modal.cancelMessage }}
                          </button>
                        </div>
                      </div>
                    </section>
                    <div class="slds-backdrop slds-backdrop_open modal-bg" role="presentation"></div>
                  </div>
                  <router-view />
                  <div class="slds-clearfix" v-if="isActiveLink('home')">
                    <h3 class="slds-welcome-mat__tile-title slds-context-bar__app-name">
                      Sell faster and smarter with the sales app
                    </h3>
                  </div>
                  <div class="demo-only demo-only_viewport" style="height:4.5rem" v-if="errors">
                    <div class="slds-notification-container">
                      <section class="slds-notification"
                        role="dialog"
                        aria-labelledby="noti-393"
                        aria-describedby="dialog-body-id-392">
                        <div class="slds-notification__body" id="dialog-body-id-392">
                          <a class="slds-notification__target slds-media" href="#">
                            <span class="slds-icon_container slds-icon-standard-event slds-media__figure" title="event">
                              <svg class="slds-icon slds-icon_small" aria-hidden="true">
                                <use xlink:href="@/assets/icons/utility-sprite/svg/symbols.svg#error"></use>
                              </svg>
                            </span>
                            <div class="slds-media__body">
                              <h2 class="slds-text-heading_small slds-m-bottom_xx-small" id="noti-393">
                                An error occurred
                              </h2>
                              <p>{{ errors }}</p>
                            </div>
                          </a>
                          <button class="slds-button slds-button_icon slds-button_icon-container slds-notification__close"
                            v-on:click="cleanErrors()">
                            <svg class="slds-button__icon" aria-hidden="true">
                              <use xlink:href="@/assets/icons/utility-sprite/svg/symbols.svg#close"></use>
                            </svg>
                          </button>
                        </div>
                      </section>
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
import router from '@/router'
import axios from 'axios'

export default {
  name: 'home-component',
  async mounted () {
    if (this.accountList.length === 0) {
      try {
        const { status, data } = await axios.get(
          'http://localhost:8080/api/account'
        )
        if (status === 200) {
          this.setAccountList(data)
        }
      } catch (e) {
        this.setErrors(e)
        let cleanErrors = setInterval(() => {
          this.setErrors(null)
          clearInterval(cleanErrors)
        }, 5000)
      }
    }
    if (this.productList.length === 0) {
      try {
        const { status, data } = await axios.get(
          'http://localhost:8080/api/product'
        )
        if (status === 200) {
          this.setProductList(data)
        }
      } catch (e) {
        this.setErrors(e)
        let cleanErrors = setInterval(() => {
          this.setErrors(null)
          clearInterval(cleanErrors)
        }, 5000)
      }
    }
  },
  computed: {
    ...mapState({
      errors: (state) => state.errors,
      showModal: (state) => state.showModal,
      modal: (state) => state.modal,
      accountList: (state) => state.accountList,
      productList: (state) => state.productList,
    }),
  },
  methods: {
    ...mapMutations([
      'setAccountList',
      'setProductList',
      'setErrors',
      'setShowModal',
    ]),
    isActiveLink(route) {
      switch (route) {
        case 'accounts':
          return router.currentRoute.value.name === route
            || router.currentRoute.value.name === 'create-order'
            || router.currentRoute.value.name === 'edit-account'

        default:
          return router.currentRoute.value.name === route
      }
    },
    confirmModal() {
      this.setShowModal(false)
      if (this.modal.confirmRoute) {
        router.push({ name: this.modal.confirmRoute })
      }
    },
    cancelModal() {
      this.setShowModal(false)
      if (this.modal.cancelRoute) {
        router.push({ name: this.modal.cancelRoute })
      }
    },
    cleanErrors() {
      this.setErrors(null)
    }
  },
}
</script>

<style>
  .modal-bg {
    position: absolute;
  }

  .slds-modal__container {
    width: 60% !important;
  }

  .slds-notification-container {
    top: 8rem;
  }
</style>
