<template>
  <div class="home">
      <Navbar/>
      <Jumbo/>
  </div>
</template>

<script>
import Navbar from "../components/sections/Navbar.vue";
import Jumbo from "../components/sections/Jumbo.vue";

export default {
    name: 'Home',
    components: {
        Navbar,
        Jumbo
    }
}
</script>

<style lang="scss" scoped>
.home{
    min-height: 100vh;
    background-image: url("~/img/wave-haikei-def.png");
    background-size: cover;
    background-repeat: no-repeat;
}
</style>