<template>
  <div class="list slds-scrollable" tabindex="0">
    <div class="slds-clearfix">
      <div class="slds-float_right">
        <h3 class="slds-welcome-mat__tile-title">
          <button class="slds-button slds-button_brand"
            v-on:click.prevent="addAccount()">
            <svg class="slds-button__icon slds-button__icon_left" aria-hidden="true">
              <use xlink:href="@/assets/icons/utility-sprite/svg/symbols.svg#new"></use>
            </svg>
            Add Account
          </button>
        </h3>
      </div>
    </div>
    <div class="slds-scrollable_y" tabindex="0">
      <table class="slds-table slds-table_cell-buffer slds-table_bordered">
        <thead>
        <tr class="slds-line-height_reset">
          <th scope="col">
            <div class="slds-truncate" title="Name">
              Name
            </div>
          </th>
          <th scope="col">
            <div class="slds-truncate" title="Phone">
              Phone
            </div>
          </th>
          <th scope="col">
            <div class="slds-truncate" title="City">
              City
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
        <tr class="slds-hint-parent" v-for="account of accountList" :key="account.id">
          <th data-label="Name" scope="row">
            <div class="slds-truncate">
              {{ account.name }}
            </div>
          </th>
          <td data-label="Phone">
            <div class="slds-truncate">
              {{ account.phone }}
            </div>
          </td>
          <td data-label="City">
            <div class="slds-truncate">
              {{ account.city }}
            </div>
          </td>
          <td data-label="Actions">
            <div class="slds-truncate action">
              <span class="slds-icon_container" title="Edit account">
                <svg class="slds-icon slds-icon_x-small slds-icon-text-default"
                  aria-hidden="true"
                  v-on:click="editAccount(account.id)">
                  <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#edit"></use>
                </svg>
              </span>
              <span class="slds-icon_container" title="Create order">
                <svg class="slds-icon slds-icon_x-small slds-icon-text-success"
                  aria-hidden="true"
                  v-on:click="createOrder(account.id)">
                  <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#add_relationship"></use>
                </svg>
              </span>
              <span class="slds-icon_container" title="Delete">
                <svg class="slds-icon slds-icon_x-small slds-icon-text-error"
                  aria-hidden="true"
                  v-on:click="removeAccount(account.id)">
                  <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#delete"></use>
                </svg>
              </span>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapActions, mapMutations, mapState } from 'vuex'
import router from '@/router'
import axios from 'axios'

export default {
  name: 'accounts-component',
  computed: {
    ...mapState({
      accountList: (state) => state.accountList,
    }),
  },
  methods: {
    ...mapMutations(['setErrors', 'setCurrentAccountId']),
    ...mapActions(['deleteAccount']),
    createOrder(accountId) {
      this.setCurrentAccountId(accountId)
      router.push({ name: 'create-order' })
    },
    addAccount() {
      router.push({ name: 'add-account' })
    },
    editAccount(accountId) {
      this.setCurrentAccountId(accountId)
      router.push({ name: 'edit-account' })
    },
    async removeAccount(accountId) {
      try {
        const { status } = await axios.delete(
          'http://localhost:8080/api/account/' + encodeURIComponent(accountId)
        )
        if (status === 204) {
          await this.deleteAccount(accountId)
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

  .slds-clearfix {
    margin-bottom: 10px;
  }

  .slds-scrollable_y {
    height:22rem;
  }
</style>
