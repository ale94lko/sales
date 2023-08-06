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
          <div class="slds-truncate action"
            v-on:click="createOrder(account.id)">
            Create Order
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapMutations, mapState } from 'vuex'
import router from "@/router";

export default {
  name: 'accounts-component',
  data () {
    return {
      selectedAccount: null,
      errors: null
    }
  },
  computed: {
    ...mapState({
      accountList: (state) => state.accountList,
    }),
  },
  methods: {
    ...mapMutations(['setCurrentAccountId']),
    createOrder(accountId) {
      this.setCurrentAccountId(accountId)
      router.push({ name: 'create-order' })
    },
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
