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
          <div class="slds-truncate" title="Phone">
            Phone
          </div>
        </th>
        <th class="" scope="col">
          <div class="slds-truncate" title="Street">
            Street
          </div>
        </th>
        <th class="" scope="col">
          <div class="slds-truncate" title="City">
            City
          </div>
        </th>
        <th class="" scope="col">
          <div class="slds-truncate" title="State">
            State
          </div>
        </th>
        <th class="" scope="col">
          <div class="slds-truncate" title="Postal Code">
            Postal Code
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
        <td data-label="Street">
          <div class="slds-truncate">
            {{ account.street }}
          </div>
        </td>
        <td data-label="City">
          <div class="slds-truncate">
            {{ account.city }}
          </div>
        </td>
        <td data-label="State">
          <div class="slds-truncate">
            {{ account.state }}
          </div>
        </td>
        <td data-label="Postal Code">
          <div class="slds-truncate">
            {{ account.postal_code }}
          </div>
        </td>
        <td data-label="Actions">
          <div class="slds-truncate action">
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
    ...mapMutations(['setCurrentAccountId']),
    ...mapActions(['deleteAccount']),
    createOrder(accountId) {
      this.setCurrentAccountId(accountId)
      router.push({ name: 'create-order' })
    },
    async removeAccount(accountId) {
      try {
        const { status } = await axios.delete(
          'http://localhost:8080/api/account/' + accountId
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
</style>
