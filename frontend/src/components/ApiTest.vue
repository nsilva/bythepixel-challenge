<script>
export default {
  data: () => ({
    apiResponse: null
  }),

  created() {
    console.log(import.meta.env.VITE_API_URL)
    this.fetchData()
  },

  methods: {
    async fetchData() {
      const url = 'http://localhost:8000/users'
      this.apiResponse = await (await fetch(url)).json()
    }
  }
}
</script>

<template>
  <div v-if="!apiResponse">
    Pinging the api...
  </div>

  <div v-if="apiResponse">
    The api responded with: <br />
    <code>
    {{ apiResponse }}
    </code>
  </div>
</template>