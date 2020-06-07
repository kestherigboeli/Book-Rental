<template>
  <div id="app">
      <navbar></navbar>

        <router-view></router-view>
  </div>
</template>

<script>
    // @ is an alias to /src
    import Navbar from '../src/components/navbar'

    export default {

        name: "Home",

        components: {
            Navbar,
        },
    };

</script>

<style lang="scss">

</style>
