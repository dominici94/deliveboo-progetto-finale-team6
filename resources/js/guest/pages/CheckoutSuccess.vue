<template>
  <main>
    <Header/>
    <!-- this.id_ordine.data -->
    <div v-if="this.id_ordine.data" class="checkout-success">
        <div class="ok">
            <span><i class="fa-solid fa-circle-check"></i></span>
        </div>
        <h3>Transazione eseguita con successo </h3>
        <h6>Id transazione: {{this.id_ordine.data}}</h6>
        <a href="/home"><button class="btn btn-deliveboo">Torna ai ristoranti</button></a>
    </div>
  </main>
</template>

<script>
import Header from "../components/macro/Header.vue";
export default {
    name: 'CheckoutSuccess',
    components: {
      Header,
    },
    data(){
        return{
            id_ordine: "",
        }
    },
  created() {
      this.id_ordine = this.$route.params;
  },
  methods:{
      passing_idordine(valore){
          this.id_ordine = valore;
      }
    }
}
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

main{
    background-color: var(--background-primary);
}

.checkout-success{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 35%;
    margin: 0 auto;
    border: 2px solid var(--primary-color);
    border-radius: 20px;
    text-align: center;
    padding: 10px;
    color: var(--text-primary);

    .ok{
        font-size: 50px;
        color: #28a745;
    }

    h3{
        font-size: 35px;
        margin: 20px 0 0px 0;
    }

    h6{
        margin-bottom: 50px;
    }

    button{
        width: 50%px;
        font-size: 17px;
        margin-bottom: 15px;
    }
}

@media screen and (max-width: 1200px){
    .checkout-success{
        width:55%;
    }
}
</style>