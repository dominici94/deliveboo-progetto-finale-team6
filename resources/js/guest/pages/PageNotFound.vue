<template>
  <div class="error">
      <h1>Pagina non trovata!! :(</h1>
      <!-- <img src="img/404.webp" alt="Error 404 Page Not Found"> -->
  </div>
</template>

<script>
export default {
    name: "PageNotFound"
}
</script>

<style lang="scss" scoped>
.error{
    
    height: 100vh;
    background-image: url("~/img/page-error.png");
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    

    h1 {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        color: #3e075f;
        position:absolute;
        top: 50%;
        left: 50%;
        translate: -50% -50%;
        font-size: 3rem;
    }
}
</style>