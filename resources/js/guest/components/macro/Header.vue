<template>
  <header>
    <nav id="nava" class="navbar navbar-light">
      <div class="logo navbar-left">
        <a href="/">
          <img src="/img/deliveboo_logo.png" alt="Deliveboo Logo" />
        </a>
      </div>

      <!-- <div class="search">
        ############################## sistemare la rotta ##########################################
        <a href="/admin/home">
                    <button>Cerca</button>
                </a>

        <input
          type="text"
          placeholder="Di cosa hai voglia?"
          v-model="searchText"
          class="input"
        />
        <button class="button">Cerca</button>
      </div> -->

      <div class="navbar-right d-flex">
        <!-- <input type="checkbox" name="theme" /> -->
        <div class="switch mr-4">
          <input
            class="switch__input"
            type="checkbox"
            id="theme"
            :checked="this.tema"
            @change="darkMode()"
          />
          <label aria-hidden="true" class="switch__label" for="theme">On</label>
          <!-- <div aria-hidden="true" class="switch__marker"></div> -->

          <img
            src="/img/head-light.png"
            class="switch__marker db-dark"
            alt="dark"
          />
          <img
            src="/img/head-dark.png"
            class="switch__marker db-light"
            alt="light"
          />
        </div>

        <button id="button-cart" class="btn navbar-toggler" @click="showCart()">
          <i class="fa-solid fa-cart-shopping"></i> {{totalQty}}{{showTotalQuantity}}
        </button>

        <div
          id="cart"
          class="cart-container p-3 mt-3"
          :class="cartVisible ? 'cart-visible' : 'not-visible'"
        >
          <div
            class="
              cart-header
              d-flex
              justify-content-between
              align-items-center
            ">
            <div>
              <i class="fa-solid fa-cart-shopping af"></i>
              <span>DeliveBoo</span>
            </div>
            <div>
              Costo Totale: <strong>{{ cart.totalPrice }}</strong> &euro;
            </div>
          </div>
          <div v-if="itemsId.length > 0" class="cart-body py-3">
            <div
              v-for="dish in cart.items"
              :key="dish.id"
              class="d-flex py-2 bordo align-items-center">
              <div class="img-container">
                <img :src="`/${dish.image}`" :alt="dish.name" />
              </div>
              <div>
                {{ dish.name }} <strong>x {{ dish.qty }}</strong>
              </div>
            </div>
          </div>
          <div class="cart-footer text-center">
            <a v-if="itemsId.length > 0" href="/home/checkout">
              <button class="btn btn-deliveboo space-btn">Vai al pagamento</button>
            </a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import axios from "axios";

export default {
  name: "Header",
  data() {
    return {
      cart: {
        items: [],
        totalPrice: 0,
      },
      itemsId: [],
      itemsQt: [],
      cartVisible: false,
      tema: false,
      totalQty: 0,
    };
  },
  created(){
    this.totalQuantity();
    if(JSON.parse(localStorage.getItem("theme")) == "dark"){
      this.darkOn();
    }
    else{
      this.darkOff();
    }
  },
  watch: {
    tema(){
        document.getElementById('corpo').classList.remove('light');
        document.getElementById('corpo').classList.add('dark');
        document.getElementById('nava').classList.remove('navbar-light');
        document.getElementById('nava').classList.add('navbar-dark');
        const parsed = JSON.stringify('dark');
        localStorage.setItem("theme", parsed);
    },
    cartVisible() {
      document.addEventListener("click", this.closeCart);
    },
  },
  computed: {
    showTotalQuantity() {
      document.addEventListener("click", this.totalQuantity);
    },
  },
  methods: {
    totalQuantity(){
      let arrayQt = JSON.parse(localStorage.getItem("qty"));
      if(arrayQt){
        let totale = 0;
        for (let i = 0; i < arrayQt.length; i++) {
          totale += arrayQt[i];
        }
        this.totalQty = totale;
      }
      else {
        this.totalQty = 0;
      }
    },
    darkOn(){
      this.tema = true;
    },
    darkOff(){
      this.tema = false;
    },
    darkMode(){
      const theme_switch = document.getElementById('theme');
      const corpo = document.getElementById('corpo');
      const navaa = document.getElementById('nava');

        if (theme_switch.checked) {
            corpo.classList.remove('light');
            corpo.classList.add('dark');
            navaa.classList.remove('navbar-light');
            navaa.classList.add('navbar-dark');
            const parsed = JSON.stringify('dark');
            localStorage.setItem("theme", parsed);
        }
        else {
            corpo.classList.remove('dark');
            corpo.classList.add('light');
            navaa.classList.remove('navbar-dark');
            navaa.classList.add('navbar-light');
            const parsed = JSON.stringify('light');
            localStorage.setItem("theme", parsed);
        }
    },
    closeCart(event) {
      if (
        document.getElementById("cart").contains(event.target) ||
        document.getElementById("button-cart").contains(event.target)
      );
      else this.cartVisible = false;
    },
    showCart() {
      if (
        localStorage.getItem("carts") &&
        localStorage.getItem("ids") &&
        localStorage.getItem("qty")
      ) {
        try {
          this.cart = JSON.parse(localStorage.getItem("carts"));
          this.itemsId = JSON.parse(localStorage.getItem("ids"));
          this.itemsQt = JSON.parse(localStorage.getItem("qty"));
        } catch (e) {}
      }
      if (this.cartVisible) {
        this.cartVisible = false;
      } else {
        this.cartVisible = true;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

header {
  border-bottom: 1px solid var(--divider);
}

nav {
  height: 100px;
  background: var(--background-primary);
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;

  img {
    width: 12.5rem;
  }

  .search {
    display: flex;
    margin-right: 1rem;
    * {
      font-size: 1rem;
      line-height: 2rem;
      padding: 5px 20px;
      border-radius: 30px;
      border: none;
    }

    .search {
      display: flex;
      margin-right: 1rem;
      * {
        font-size: 1rem;
        line-height: 2rem;
        padding: 5px 20px;
        border-radius: 30px;
        border: none;
      }

      input {
        margin-right: 10px;
        width: 100%;
        border: 1px solid var(--divider);
      }

      input[type="text"]:focus {
        outline: 2px solid var(--primary-color);
      }

      button {
        font-weight: bold;
        border: 2px solid var(--primary-color);
        background-color: transparent;
        // color: #37b9b4;
        color: var(--primary-color);
        transition: all 0.1s ease;
        cursor: pointer;
        &:active {
          background-color: var(--primary-color);
          color: white;
        }
      }
    }

    button {
      font-weight: bold;
      border: 2px solid var(--primary-color);
      background-color: transparent;
      // color: #37b9b4;
      color: var(--primary-color);
      transition: all 0.1s ease;
      cursor: pointer;
      &:active {
        background-color: var(--primary-color);
        color: white;
      }
    }
  }
}

button:hover {
  scale: 1.1;
  transition: 1s;
}

.navbar-right {
  position: relative;
}

.fa-cart-shopping {
  color: var(--primary-color);
}

.cart-container {
  // display: none;
  position: absolute;
  top: 30px;
  right: 0;
  border: 1px solid var(--primary-color);
  background-color: white;
  width: 31.25rem;
  background-color: var(--background-primary);
  color: var(--title-primary);

  .cart-header {
    position: relative;
  }

  &::after,
  &::before {
    content: "\f0d8";
    position: absolute;
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    right: 13px;
    font-size: 25px;
  }
  &::before {
    color: var(--primary-color);
    top: -22px;
  }
  &::after {
    color: var(--background-primary);
    top: -21px;
  }
}

.bordo {
  border-bottom: 1px solid var(--divider);
}

.space-btn {
  padding: 5px 30px;
}

.img-container {
  width: 10%;
  margin-right: 10px;

  img {
    width: 100%;
    border-radius: 10px;
  }
}

.cart-visible {
  display: block;
}

.not-visible {
  display: none;
}

.switch {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  position: relative;
  width: 64px;
  height: 32px;
  border-radius: 50em;
  padding: 3px 0;
  z-index: 0;
}

.switch__input,
.switch__label {
  position: absolute;
  left: 0;
  top: 0;
}

.switch__input {
  margin: 0;
  padding: 0;
  opacity: 0;
  height: 0;
  width: 0;
  pointer-events: none;
}

.db-dark {
  display: none;
}

.switch__input:checked + .switch__label {
  // background-color: hsl(228, 74%, 61%);
  background-color: var(--secondary-color);
}

.switch__input:checked + .switch__label + .switch__marker {
  left: calc(100% - 45px);
}

.switch__input:checked + .switch__label + .switch__marker.db-dark {
  display: block;
}

.switch__input:checked ~ .db-light {
  display: none;
}

.switch__input:focus + .switch__label,
.switch__input:active + .switch__label {
  box-shadow: undefined;
}

.switch__input:focus + .switch__label,
.switch__input:active + .switch__label {
  box-shadow: 0 0 0 3px hsla(228, 74%, 61%, 0.2);
}

.switch__label {
  width: 100%;
  height: 100%;
  color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-color: var(--secondary-color);
  border-radius: inherit;
  z-index: 1;
  transition: background 0.2s;
}

.switch__marker {
  position: relative;
  left: -20px;
  top: -2px;
  width: 59px;
  border-radius: 50%;
  z-index: 2;
  pointer-events: none;
  transition: left 0.2s;
  will-change: left;
}

@media screen and (max-width:576px) {
  .cart-container {
    width: 25rem;
  }
}
</style>