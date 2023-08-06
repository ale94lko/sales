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
                      Home
                    </router-link>
                  </li>
                  <li v-bind:class="[
                      'slds-context-bar__item',
                      { 'slds-is-active': isActiveLink('accounts') },
                    ]">
                    <router-link to="/accounts" class="slds-context-bar__label-action">
                      Accounts
                    </router-link>
                  </li>
                  <li v-bind:class="[
                      'slds-context-bar__item',
                      { 'slds-is-active': isActiveLink('products') },
                    ]">
                    <router-link to="/accounts" class="slds-context-bar__label-action">
                      Products
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
import router from '@/router'

export default {
  name: 'home-component',
  methods: {
    isActiveLink(route) {
      return router.currentRoute.value.name === route
    },
  },
}
</script>
