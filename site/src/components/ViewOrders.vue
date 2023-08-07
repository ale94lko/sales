<template>
  <div class="list slds-scrollable" tabindex="0">
    <div class="slds-scrollable_y" tabindex="0">
      <table class="slds-table slds-table_cell-buffer slds-table_bordered">
        <thead>
        <tr class="slds-line-height_reset">
          <th scope="col">
            <div class="slds-truncate" title="Subtotal">
              Subtotal
            </div>
          </th>
          <th scope="col">
            <div class="slds-truncate" title="Taxes">
              Taxes
            </div>
          </th>
          <th scope="col">
            <div class="slds-truncate" title="Total">
              Total
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
        <tr class="slds-hint-parent" v-for="order of orderList" :key="order.id">
          <td data-label="Subtotal">
            <div class="slds-truncate">
              {{ order.subtotal }}
            </div>
          </td>
          <td data-label="Taxes">
            <div class="slds-truncate">
              {{ order.taxes }}
            </div>
          </td>
          <td data-label="Total Amount">
            <div class="slds-truncate">
              {{ order.total }}
            </div>
          </td>
          <td data-label="Actions">
            <div class="slds-truncate action">
              <span class="slds-icon_container" title="Delete Order">
                <svg class="slds-icon slds-icon_x-small slds-icon-text-error"
                  aria-hidden="true"
                  v-on:click="removeOrder(order.id)">
                  <use xlink:href="@/assets/icons/action-sprite/svg/symbols.svg#delete"></use>
                </svg>
              </span>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="slds-float_right">
        <button class="slds-button slds-button_neutral"
          v-on:click.prevent="cancel()">
          Go back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapState } from 'vuex'
import router from '@/router'
import axios from 'axios'

export default {
  name: 'accounts-component',
  data() {
    return {
      orderList: [],
    }
  },
  async mounted () {
    if (this.accountId === null) {
      this.setErrors('Please select an account to see orders')
      let cleanErrors = setInterval(() => {
        this.setErrors(null)
        clearInterval(cleanErrors)
      }, 5000)
      await router.push({name: 'accounts'})
    } else {
      try {
        const { status, data } = await axios.get(
          'http://localhost:8080/api/order'
        )
        if (status === 200) {
          this.orderList = data.filter((item) => {
            return item.account_id === this.accountId
          })
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
      accountId: (state) => state.currentAccountId,
    }),
  },
  methods: {
    ...mapMutations([
      'setErrors',
      'setModal',
      'setShowModal',
    ]),
    async removeOrder(orderId) {
      try {
        const { status } = await axios.delete(
          'http://localhost:8080/api/order/' + encodeURIComponent(orderId)
        )
        if (status === 204) {
          let index = this.orderList.findIndex((order) => {
            return order.id = orderId
          })
          if (index !== -1) {
            this.orderList.splice(index, 1)
          }
          let modal = {
            title: 'Successful Operation',
            message: 'Order successfully deleted',
            confirmRoute: null,
            confirmMessage: 'Keep on list',
            cancelRoute: 'accounts',
            cancelMessage: 'Go back',
          }
          this.setModal(modal)
          this.setShowModal(true)
        }
      } catch (e) {
        this.setErrors(e)
        let cleanErrors = setInterval(() => {
          this.setErrors(null)
          clearInterval(cleanErrors)
        }, 5000)
      }
    },
    cancel() {
      router.push({ name: 'accounts' })
    }
  }
}
</script>

<style scoped>
  .slds-scrollable_y {
    height:22rem;
  }

  .slds-float_right {
    margin-top: 10px;
  }
</style>
