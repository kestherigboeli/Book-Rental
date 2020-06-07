<template>
  <div id="app">
      <navbar></navbar>

      <div class="container m-md-auto">
        <router-view></router-view>
      </div>
  </div>
</template>

<script>
    // @ is an alias to /src
    import Navbar from '../src/components/navbar'
    export default {
        name: "Home",
        components: {
            Navbar,
        }
    };

</script>

<style lang="scss">

</style>
