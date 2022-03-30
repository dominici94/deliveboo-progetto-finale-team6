<template>
  <router-view :key="$route.path"></router-view>
</template>

<script>
export default {
  name: "Main",
};
</script>

<style lang="scss" scoped>
main {
  height: 100vh;
  // background-image: url("~/img/wave-haikei-def.png");
  background-repeat: no-repeat;
  background-size: cover;
  overflow-y: scroll;
}
</style>