<template>
  <div class="single-restaurant">
    <Header class="header" />
    <!-- se il ristorante ha almeno un piatto mostro i dati del ristorante -->
    <div class="restaurant">
      <div class="rest-image-container">
        <img :src="`/${restaurant.image}`" alt="" />
        <img :src="`/storage/${restaurant.image}`" alt="" />
      </div>

      <div class="rest-text">
        <h1>{{ restaurant.name }}</h1>
        <p>{{ restaurant.description }}</p>
      </div>
    </div>
    <div v-if="this.differentRestaurant" class="diff-rest">
      <div class="alert">
        <h4>Attenzione</h4>
        <p>
          Hey hai già un carrello esistente con un'altro ristorante, cosa vuoi
          fare?
        </p>
        <div class="button-alert">
          <button class="btn btn-deliveboo" @click="backToRestaurant()">
            Torna al ristorante
          </button>
          <button class="btn btn-danger" @click="deleteCart()">
            Elimina carrello
          </button>
        </div>
      </div>
    </div>
    <div v-if="!this.differentRestaurant" class="wrapper">
      <!-- lista dei piatti -->
      <div class="dishes-list">
        <!-- se c'è almeno un piatto nel menu lo mostro -->
        <ul v-if="dishes.length > 0">
          <li v-for="dish in dishes" :key="dish.id">
            <div class="dish-card">
              <div class="card-text">
                <h2>{{ dish.name }}</h2>
                <p>{{ dish.description }}</p>
                <h3>{{ dish.price }} €</h3>

                <!-- aggiungi al carrello -->
                <div v-if="!itemsId.includes(dish.id)" class="add-dish">
                  <span>Aggiungi al carrello</span
                  ><i @click="addItem(dish)" class="fa-solid fa-cart-plus"></i>
                </div>
                <div v-else class="add-dish">
                  <span>
                    <i class="fa-solid fa-minus" @click="removeItem(dish)"></i>
                    {{ dish.qty }}
                    <i class="fa-solid fa-plus" @click="addItem(dish)"></i>
                    <i
                      class="fa-solid fa-trash-can"
                      @click="removeAllItems(dish)"
                    ></i>
                  </span>
                </div>
              </div>

              <div class="card-image-container">
                <img
                  v-if="checkImage(dish.image)"
                  :src="`/${dish.image}`"
                  alt=""
                />
                <img v-else :src="`/storage/${dish.image}`" alt="" />
              </div>
            </div>
          </li>
        </ul>
        <h2 v-else>Non ci sono piatti disponibili</h2>
      </div>

      <!-- carrello -->
      <div v-if="!this.differentRestaurant" class="aside-cart">
        <div class="cart">
          <h3>Carrello</h3>
          <div class="cart-items" v-if="cart.items.length > 0">
            <ul class="cart-dishes">
              <li class="item" v-for="item in cart.items" :key="item.id">
                {{ item.name }}
                <span>
                  <i class="fa-solid fa-minus" @click="removeItem(item)"></i>
                  {{ item.qty }}
                  <i class="fa-solid fa-plus" @click="addItem(item)"></i>
                  <i
                    class="fa-solid fa-trash-can"
                    @click="removeAllItems(item)"
                  ></i>
                </span>
              </li>
              <li class="total-cost">
                Costo totale: {{ cart.totalPrice }} &euro;
              </li>
            </ul>
          </div>
          <div v-else class="cart-empty">
            <h5>Il carrello è vuoto 🙄</h5>
          </div>
        </div>
        <div class="btn-check-cont">
          <a
            class="btn-checkout"
            :href="cart.items.length > 0 ? '/home/checkout' : '#'"
            ><button class="btn btn-deliveboo">Vai al pagamento</button></a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../components/macro/Header.vue";

export default {
  name: "SingleRestaurant",
  components: {
    Header,
  },
  data() {
    return {
      restaurant: [],
      restaurant_id: 0,
      dishes: [],
      cart: {
        items: [],
        totalPrice: 0,
      },
      itemsId: [],
      itemsQt: [],
      differentRestaurant: false,
    };
  },
  created() {
    axios
      .get(`/api/restaurant/${this.$route.params.slug}`)
      .then((response) => {
        this.restaurant = response.data;
        this.restaurant_id = response.data.id;
      })
      .catch((error) => {
        this.$router.push({ name: "page-404" });
      });
    axios
      .get(`/api/restaurant/dishes/${this.$route.params.slug}`)
      .then((response) => {
        this.dishes = response.data;
      });
    this.cdCart();
  },
  mounted() {
    if (
      localStorage.getItem("carts") &&
      localStorage.getItem("ids") &&
      localStorage.getItem("qty")
    ) {
      try {
        this.cart = JSON.parse(localStorage.getItem("carts"));
        this.itemsId = JSON.parse(localStorage.getItem("ids"));
        this.itemsQt = JSON.parse(localStorage.getItem("qty"));
      } catch (e) {
        localStorage.removeItem("carts");
        localStorage.removeItem("ids");
        localStorage.removeItem("qty");
      }
    }
  },
  computed: {
    showTotalPrice() {
      return this.cart.totalPrice;
    },
    showItemsId() {
      return this.itemsId.toString();
    },
    showItemsQty() {
      return this.itemsQt.toString();
    },
  },
  methods: {
    cdCart() {
      this.check_and_delete_Cart = setTimeout(() => {
        if (this.cart.items.length > 0) {
          if (this.cart.items[0].restaurant_id != this.restaurant.id) {
            this.differentRestaurant = true;
          }
        }
      }, 1000);
    },
    backToRestaurant() {
      let slugLink = this.cart.items[0].restaurant.slug;
      this.$router.push(`/home/${slugLink}`);
    },
    deleteCart() {
      localStorage.removeItem("carts");
      localStorage.removeItem("ids");
      localStorage.removeItem("qty");
      this.cart = {
        items: [],
        totalPrice: 0,
      };
      this.itemsId = [];
      this.itemsQt = [];

      this.differentRestaurant = false;
    },
    checkImage($path) {
      if ($path.includes("img/")) return true;
    },
    addItem(dish) {
      if (!dish.hasOwnProperty("qty")) {
        dish.qty = 0;
      }

      if (this.cart.items.includes(dish)) {
        dish.qty += 1;
        let index = this.cart.items.indexOf(dish);
        this.itemsQt.splice(index, 1, dish.qty);
      } else {
        this.itemsQt.push(1);
        this.itemsId.push(dish.id);
        dish.qty = 1;
        this.cart.items.push(dish);
      }
      this.cart.totalPrice += dish.price;
      this.cart.totalPrice = parseFloat(this.cart.totalPrice.toFixed(2));
      this.saveItem();
    },
    removeItem(item) {
      this.cart.totalPrice -= item.price;
      this.cart.totalPrice = parseFloat(this.cart.totalPrice.toFixed(2));

      if (this.cart.items.includes(item)) {
        item.qty -= 1;

        let index = this.cart.items.indexOf(item);
        this.itemsQt.splice(index, 1, item.qty);
        if (item.qty < 1) {
          // let index=this.cart.items.indexOf(item);
          if (index >= 0) {
            this.itemsQt.splice(index, 1);
            this.itemsId.splice(index, 1);
            this.cart.items.splice(index, 1);
          }
        }
      }
      this.saveItem();
    },
    removeAllItems(item) {
      this.cart.totalPrice -= item.price * item.qty;
      this.cart.totalPrice = parseFloat(this.cart.totalPrice.toFixed(2));

      let index = this.cart.items.indexOf(item);
      if (index >= 0) {
        this.cart.items.splice(index, 1);
        this.itemsId.splice(index, 1);
        this.itemsQt.splice(index, 1);
      }
      //localStorage.removeItem(item);
      this.saveItem();
    },
    saveItem() {
      // this.passData();
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem("carts", parsed);
      const parsedId = JSON.stringify(this.itemsId);
      localStorage.setItem("ids", parsedId);
      const parsedQty = JSON.stringify(this.itemsQt);
      localStorage.setItem("qty", parsedQty);
      // sessionStorage.setItem('carts',parsed);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";
.single-restaurant {
  min-height: 100vh;
  background-color: var(--background-primary);
}
// ristorante
.restaurant {
  padding: 1.25rem;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  border-bottom: 1px solid var(--divider);
  -webkit-box-shadow: 0px 8px 10px -10px rgba(0, 0, 0, 0.4);
  box-shadow: 0px 8px 10px -10px rgba(0, 0, 0, 0.4);
  background-color: var(--background-primary);
}

.diff-rest {
  background-color: var(--background-primary);
  color: var(--text-primary);
}

.alert {
  width: 40%;
  margin: 50px auto 0;
  text-align: center;
  border: 1px solid var(--primary-color);

  h4 {
    color: var(--primary-color);
  }

  p {
    font-size: 17px;
  }

  .button-alert {
    .btn-deliveboo {
      margin: 10px 0;

      &:active {
        transform: inherit;
      }
    }
  }
}

.rest-image-container {
  width: 100%;
  margin-top: -20px;
  img {
    width: 100%;
  }

  & > img:last-child {
    margin-top: -20px;
  }
}

.rest-text {
  padding: 20px;
  h1 {
    color: var(--title-primary);
  }
  p {
    display: none;
    color: var(--title-primary);
  }
}
// fine ristorante
.fa-solid {
  cursor: pointer;

  &:active {
    transform: scale(0.8);
  }
}

.fa-plus,
.fa-minus {
  color: var(--primary-color);
  font-size: 10px;
  border: 1px solid var(--primary-color);
  border-radius: 50%;
  padding: 5px;
  margin: 0 8px;
}

.fa-trash-can {
  color: var(--trash-color);
  font-size: 20px;
  vertical-align: text-top;
  margin-left: 8px;
}
.wrapper {
  display: flex;
  position: relative;
  background-color: var(--background-primary);

  .aside-cart {
    position: sticky;
    top: 0;
    flex-grow: 1;
    padding: 1.25rem;
    height: fit-content;

    .btn-check-cont {
      width: 70%;
      padding-top: 20px;
      margin: auto;

      .btn-checkout {
        width: 100%;
        display: block;

        button {
          width: 100%;
        }
      }
    }

    .cart {
      position: relative;
      min-height: 400px;
      max-height: 700px;
      overflow-y: scroll;
      border: 1px solid var(--divider);
      border-radius: 20px;
      -ms-overflow-style: none; /* for Internet Explorer, Edge */
      scrollbar-width: none;
      -webkit-box-shadow: 17px 0px 24px -20px var(--divider);
      -moz-box-shadow: 17px 0px 24px -20px var(--divider);
      box-shadow: 17px 0px 24px -20px var(--divider);

      &::-webkit-scrollbar {
        display: none; /* for Chrome, Safari, and Opera */
      }

      h3 {
        text-align: center;
        margin-bottom: 20px;
        margin-top: 20px;
        color: var(--title-primary);
      }

      .cart-empty {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: var(--title-primary);
      }

      .total-cost {
        border: 1px solid var(--secondary-color);
        padding-top: 10px;
        background-color: whitesmoke;
        margin-bottom: 0;
        padding-left: 5px;
      }

      .item {
        width: 80%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px 5px 10px;
        margin: auto;
        margin-bottom: 30px;
        color: var(--title-primary);
      }
    }
  }
}

// piatti
.dishes-list {
  width: 70%;
  margin: 20px;
  border-right: 1px solid var(--divider);
  padding-right: 20px;
  color: var(--text-primary);
}

ul {
  padding-inline-start: 0;

  li {
    margin-bottom: 30px;
    padding-bottom: 10px;
  }

  li:not(:last-child) {
    border-bottom: 1px solid var(--divider);
  }
}

.dish-card {
  display: flex;
  flex-wrap: wrap;
  padding: 2em;

  .card-text {
    width: 100%;
    padding: 0 10px;

    h2 {
      font-weight: bold;
    }

    p {
      margin: 1rem 0;
    }
  }

  .card-image-container {
    width: 100%;
    img {
      width: 100%;
      object-fit: cover;
      height: 200px;
      border-radius: 20px;
    }
  }

  .add-dish {
    display: flex;
    align-items: center;
    margin-top: 20px;
    color: var(--text-primary);

    span {
      font-weight: 600;
      margin-right: 5px;
    }

    .fa-cart-plus {
      font-size: 20px;
      color: var(--primary-color);
      cursor: pointer;

      &:active {
        transform: scale(0.8);
      }
    }
  }
}

.dish-card:hover {
  cursor: pointer;
  -webkit-box-shadow: 5px 8px 11px -5px #000000;
  box-shadow: 5px 8px 1px -6px var(--primary-color) inset;
}
// fine piatti

@media screen and (min-width: 576px) {
  .restaurant {
    padding: 20px;
    text-align: justify;
  }

  // .rest-image-container {
  //   width: 30%;
  //   margin-top: 0;
  //   border-radius: 5px;

  //   img {
  //     border-radius: 5px;
  //   }
  // }

  // .rest-text {
  //   padding: 0 0 0 30px;
  //   width: 70%;
  //   p {
  //     display: block;
  //   }
  // }

  .dish-card {
    flex-direction: column;

    .card-text {
      width: 100%;
      margin-bottom: 1rem;
    }

    .card-image-container {
      width: 100%;
    }
  }

  .item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;

    span {
      margin-top: 1rem;
    }
  }
}

@media screen and (min-width: 768px) {
  .restaurant {
    padding: 20px;
    text-align: justify;
  }

  .rest-image-container {
    width: 30%;
    margin-top: 0;
    border-radius: 5px;

    img {
      border-radius: 5px;
    }
  }

  .rest-text {
    padding: 0 0 0 30px;
    width: 70%;
    p {
      display: block;
    }
  }

  .dish-card {
    display: flex;
    flex-direction: row;
    justify-content: space-between;

    .card-text {
      width: 40%;
    }

    .card-image-container {
      width: 40%;
    }
  }
}
.header {
  z-index: 999;
  position: relative;
}

@media screen and (max-width: 992px) {
  .header {
    position: sticky;
    top: 0;
    background-color: #fff;
  }

  .aside-cart {
    display: none;
  }
  .dishes-list {
    width: 100%;
    border: none;
  }
}
</style>