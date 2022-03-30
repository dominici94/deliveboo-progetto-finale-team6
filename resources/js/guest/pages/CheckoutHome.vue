<template>
  <main>
    <Header/>
    <CheckoutForm/>
    <Footer/>
  </main>
</template>

<script>
import Header from "../components/macro/Header.vue";
import CheckoutForm from "../components/sections/CheckoutForm.vue";
import Footer from "../components/macro/Footer.vue";
export default {
    name: 'CheckoutHome',
    components: {
      Header,
      CheckoutForm,
      Footer,
  },
}
</script>

<style>

</style>