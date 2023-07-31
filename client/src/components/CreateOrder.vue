<template>
  <div class="create-order">
  </div>
</template>

<script>
import axios from 'axios'
import router from '../router'

export default {
  name: 'create-order',
  data () {
    return {
      products: [],
      errors: null
    }
  },
  async mounted () {
    try {
      const { status, data } = await axios.get(
        'http://localhost:8080/api/product'
      )
      if (status === 200) {
        this.accounts = data
      }
    } catch (e) {
      this.errors = e
    }
  },
  methods: {
    async addOrder () {
      try {
        router.move('create-order')
      } catch (e) {
        this.errors = e
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
