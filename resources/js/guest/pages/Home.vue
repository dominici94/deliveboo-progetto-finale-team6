<template>
  <main>
    <Header class="header" />
    <div class="d-flex flex-wrap">
      <Aside class="left-side" />
      <Restaurants class="right-side" />
    </div>
    <Footer/>
  </main>
</template>

<script>
import Header from "../components/macro/Header.vue";
import Restaurants from "../components/sections/Restaurants.vue";
import Aside from "../components/sections/Aside.vue";
import Footer from "../components/macro/Footer.vue";

export default {
  name: "Home",
  components: {
    Header,
    Aside,
    Restaurants,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

.header {
  z-index: 999;
  position: relative;
  background-color: var(--background-primary);
}

div{
  margin-bottom: 50px;
}

main {
  //   background-image: url("~/img/wave-haikei-def.png");
  //   background-repeat: no-repeat;
  //   background-size: cover;
  background-color: var(--background-primary);
}
@media screen and (max-width: 992px) {
  .header{
    position: sticky;
    top: 0;
    background-color: #fff;
  }

  .left-side {
    // display: none;
    border: none;
    width: 100%;
  }
}

@media screen and (min-width: 992px) {

  .left-side {
    // display: block;
    width: 20%;
  }
  .right-side {
    width: 80%;
  }
}
</style>