<template>
  <div class="jumbo">
    <div class="container">
      <h1>I piatti che ami, a domicilio.</h1>
      <div class="img_container">
        <!-- immagine da inserire -->
        <img src="img/base_home.jpg" alt="Deliveroo Graphic Art" />
      </div>
    </div>
    <!-- tasto che reindirizza alla pagina ristoranti e piatti -->
    <div class="search">
      <a href="/home">
        <button>Comincia</button>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Jumbo",
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

.jumbo {
  .container {
    // width: 60%;
    max-width: 75rem;
    margin-bottom: 20px;
    text-align: center;
    font-family: "IBM Plex Sans", sans-serif;

    .img_container {
      width: 100%;
      img {
        width: 100%;
        border-radius: 1rem;
        -webkit-box-shadow: 5px 5px 15px 5px #000000;
        box-shadow: 5px 5px 15px 5px #000000;
      }
    }
  }

  .search {
    text-align: center;

    button {
      font-weight: bold;
      font-size: 1.5rem;
      padding: 1.25rem;
      border: 2px solid var(--title-color);
      border-radius: 1rem;
      background-color: var(--title-color);
      color: var(--secondary-color);
      cursor: pointer;
      -webkit-box-shadow: 5px 5px 15px 5px #000000;
      box-shadow: 5px 5px 15px 5px #000000;

      &:active {
        background-color: #3e075f;
        color: white;
      }
    }
  }

  button:hover {
    scale: 1.1;
    transition: ease-in-out 0.5s;
  }
}

// MEDIA QUERIES

@media screen and (max-width: 1920px) {
  .container {
    width: 60%;
  }
}

@media screen and (max-width: 992px) {
  .container {
    width: 100%;
    margin-top: 50px;
  }

  img {
    margin: 20px 0;
  }

  h1 {
    font-size: 2rem;
  }
}
</style>