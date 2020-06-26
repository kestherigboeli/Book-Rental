<template>
  <div id="app">
      <navbar> </navbar>
 	  <router-view> </router-view>
  </div>
</template>

<script>
    // @ is an alias to /src
    import Navbar from '../src/components/navbar'

    export default {
        components: {
            Navbar,
        },
    }

</script>

<style lang="scss">

</style>
