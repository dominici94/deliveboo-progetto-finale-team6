<template>
  <section>
    <div class="container" v-if="cart.items.length > 0">
      <div class="checkout_cont">
        <form id="payment-form">
          <div class="form-group">
            <label for="name">Nome*</label>
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Inserisci il nome"
              v-model="name"
              required
            />
            <div id="error-name" class="alert alert-danger invisibile">
              Inserire il nome
            </div>
          </div>
          <div class="form-group">
            <label for="surname">Cognome*</label>
            <input
              type="text"
              class="form-control"
              id="surname"
              placeholder="Inserisci il cognome"
              v-model="surname"
              required
            />
            <div id="error-surname" class="alert alert-danger invisibile">
              Inserire il cognome
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email*</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Inserisci la tua email"
              v-model="email"
              required
            />
            <div id="error-email" class="alert alert-danger invisibile">
              Inserire una email
            </div>
          </div>
          <div class="form-group">
            <label for="address">Indirizzo*</label>
            <input
              type="text"
              class="form-control"
              id="address"
              placeholder="Inserisci l'indirizzo di consegna"
              v-model="address"
              required
            />
            <div id="error-address" class="alert alert-danger invisibile">
              Inserire un indirizzo
            </div>
          </div>
          <div class="form-group">
            <label for="telephone">Telefono*</label>
            <input
              type="number"
              class="form-control"
              id="telephone"
              placeholder="Inserisci il numero di telefono"
              v-model="telephone"
            />
            <div id="error-number" class="alert alert-danger invisibile">
              Inserire un numero di telefono di 10 cifre
            </div>
          </div>
          <div class="form-group">
            <label for="notes">Note</label>
            <textarea
              class="form-control"
              id="notes"
              placeholder="Inserisci eventuali note"
              rows="8"
              v-model="notes"
            ></textarea>
          </div>
          <div class="claudio_button">
            <div id="dropin-container"></div>
            <input type="hidden" id="nonce" name="payment_method_nonce" />
            <input
              class="btn btn-deliveboo"
              type="submit"
              :value="`Paga ${cart.totalPrice} €`"
            />
          </div>
        </form>
      </div>
      <div class="cart_cont">
        <div class="cart">
          <h3>Riepilogo carrello</h3>
          <div class="cart-items" v-if="cart.items.length > 0">
            <ul class="cart-dishes">
              <li class="item" v-for="item in cart.items" :key="item.id">
                {{ item.name }} x {{ item.qty }}
                <div class="img-container">
                  <img :src="`/${item.image}`" :alt="item.name" />
                </div>
              </li>
              <li class="total-cost">
                Costo totale: {{ cart.totalPrice }} &euro;
              </li>
            </ul>
          </div>
          <div v-else>
            <h5>Il carrello è vuoto</h5>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="cart-empty">
      <h2>Il carrello è vuoto 😡</h2>
    </div>
  </section>
</template>

<script>
export default {
  name: "CheckoutForm",
  data() {
    return {
      name: "",
      surname: "",
      email: "",
      address: "",
      telephone: "",
      notes: "",
      cart: {
        items: [],
        totalPrice: 0,
      },
      itemsId: [],
      itemsQt: [],
    };
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
  created() {
    axios.get("/api/token/get-token/").then((response) => {
      const form = document.getElementById("payment-form");
      braintree.dropin.create(
        {
          container: document.getElementById("dropin-container"),
          authorization: response.data,
          container: "#dropin-container",
        },
        (error, dropinInstance) => {
          if (error) console.error(error);

          form.addEventListener("submit", (event) => {
            event.preventDefault();

            // ********************************* JAVASCRIPT *******************************************

            let nome = document.getElementById("name").value;
            let surname = document.getElementById("surname").value;
            let address = document.getElementById("address").value;
            let email = document.getElementById("email").value;
            let telephone = document.getElementById("telephone").value;

            if (nome === "") {
              document.getElementById("error-name").classList.add("invalido");
              document
                .getElementById("error-name")
                .classList.remove("invisibile");
            } else {
              document.getElementById("error-name").classList.add("invisibile");
              document
                .getElementById("error-name")
                .classList.remove("invalido");
            }

            if (surname == "") {
              document
                .getElementById("error-surname")
                .classList.remove("invisibile");
              document
                .getElementById("error-surname")
                .classList.add("invalido");
            } else {
              document
                .getElementById("error-surname")
                .classList.add("invisibile");
              document
                .getElementById("error-surname")
                .classList.remove("invalido");
            }

            if (address == "") {
              document
                .getElementById("error-address")
                .classList.remove("invisibile");
              document
                .getElementById("error-address")
                .classList.add("invalido");
            } else {
              document
                .getElementById("error-address")
                .classList.add("invisibile");
              document
                .getElementById("error-address")
                .classList.remove("invalido");
            }

            if (email == "") {
              document
                .getElementById("error-email")
                .classList.remove("invisibile");
              document.getElementById("error-email").classList.add("invalido");
            } else {
              document
                .getElementById("error-email")
                .classList.add("invisibile");
              document
                .getElementById("error-email")
                .classList.remove("invalido");
            }

            if (isNaN(telephone) || telephone.length != 10) {
              document
                .getElementById("error-number")
                .classList.remove("invisibile");
              document.getElementById("error-number").classList.add("invalido");
            } else {
              document
                .getElementById("error-number")
                .classList.add("invisibile");
              document
                .getElementById("error-number")
                .classList.remove("invalido");
            }

            dropinInstance.requestPaymentMethod((error, payload) => {
              if (error) console.error(error);

              document.getElementById("nonce").value = payload.nonce;
              // form.submit();
              let dati = {
                name: this.name,
                surname: this.surname,
                email: this.email,
                address: this.address,
                telephone: this.telephone,
                totalPrice: this.cart.totalPrice,
                notes: this.notes,
                dishId: this.itemsId,
                dishQt: this.itemsQt,
                payment_method_nonce: payload.nonce,
              };
              axios
                .post("/api/checkout", dati)
                .then((response) => {
                  console.log(response.data);
                  this.deleteCart();
                  this.$router.push({
                    name: "checkout-success",
                    params: { data: response.data },
                  });
                })
                .catch((error) => {
                  console.log(error);
                });
            });
          });
        }
      );
    });
  },
  methods: {
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
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

textarea {
  resize: none;
}

section{
  background-color: var(--background-primary);
  min-height: 800px;
}

label{
  color: var(--text-primary);
}

.container {
  display: flex;
  padding: 5rem 0;

  .checkout_cont {
    width: 50%;

    .claudio_button {
      text-align: center;
    }
  }

  .cart_cont {
    width: 50%;
    color: var(--text-primary);

    .cart {
      h3 {
        text-align: center;
        margin-bottom: 20px;
      }

      .total-cost {
        border-top: 1px solid var(--primary-color);
        padding-top: 10px;
      }

      .item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;

        &:not(:first-of-type) {
          border-top: 1px solid var(--divider);
        }

        .img-container {
          width: 10%;
          margin-right: 10px;

          img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
          }
        }
      }
    }
  }
}
.invisibile {
  display: none;
}

.invalido {
  display: block;
}

.cart-empty {
  width: 100%;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}



@media screen and (max-width: 576px) {
  .container {
    padding: 25px;
  }
  .cart_cont {
    display: none;
  }
  .checkout_cont {
    flex-grow: 1;
  }
}

</style>