<template>
  <div class="restaurants">
    <h1 class="restaurants__title">Scopri i ristoranti di tendenza</h1>
    <ul>
      <li
        class="badge badge-category-search"
        v-for="typo in checkedName"
        :key="typo.id"
      >
        {{ typo }}
      </li>
    </ul>
    <div class="restaurants__list">
      <div
        class="restaurants__card"
        v-for="restaurant in restaurants"
        :key="restaurant.id"
      >
        <router-link
          class="link"
          :to="{
            name: 'single-restaurant',
            params: { slug: restaurant.slug },
          }"
        >
          <div>
            <div class="restaurants__content">
              <img
                v-if="restaurant.image.includes('img/')"
                :src="`/${restaurant.image}`"
                :alt="restaurant.name"
                class="restaurants__image"
              />
              <img
                v-else
                :src="`/storage/${restaurant.image}`"
                :alt="restaurant.name"
                class="restaurants__image"
              />
              <span class="restaurants__name">{{ restaurant.name }}</span>
              <p class="restaurants__category">
                <span
                  class="badge badge-deliveboo-category"
                  v-for="typology in restaurant.typologies"
                  :key="typology.id"
                  >{{ typology.category }}</span
                >
              </p>
              <span class="restaurants__badge">Consegna gratuita</span>
              <span class="restaurants__delivery">15-20 min</span>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "../../front.js";
export default {
  name: "Restaurants",
  data() {
    return {
      restaurants: [],
      checked: [],
      checkedName: [],
    };
  },
  created() {
    axios.get("/api/restaurants/").then((response) => {
      this.restaurants = response.data;
    });

    bus.$on("passing_category", this.passing_category);
    bus.$on("passing_category-name", this.passing_categoryName);
  },
  methods: {
    // restaurants_filters(){
    //   if(this.checked.length == 0){
    //     this.restaurants_filter = this.restaurants;
    //     return;
    //   }
    //   this.restaurants_filter = [];
    //   for(let i = 0; i < this.checked.length; i++){
    //     for(let j = 0; j < this.restaurants.length; j++){
    //       for(let k = 0; k < this.restaurants[j].typologies.length; k++){
    //         if(this.restaurants[j].typologies[k].id == this.checked[i]){
    //           if(! this.restaurants_filter.includes(this.restaurants[j]))this.restaurants_filter.push(this.restaurants[j]);
    //         }
    //       }
    //     }
    //   }
    // },
    restaurants_filters() {
      axios.get(`/api/restaurants/${this.checked}`).then((response) => {
        this.restaurants = response.data;
      });
    },

    passing_category(valori) {
      this.checked = valori;
      this.restaurants_filters();
    },
    passing_categoryName(valori) {
      this.checkedName = valori;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";


.restaurants {
  padding: 1rem;
  min-height: 800px;

  &__title {
    color: var(--title-primary);
    margin-left: 10px;
  }

  &__list {
    display: flex;
    flex-wrap: wrap;
    padding-inline-start: 0;
  }

  &__card {
    width: calc((100% / 4) - 1.25rem);
    border: 1px solid rgb(194, 194, 194);
    border-radius: 0.375rem;
    margin: 0 10px 20px 10px;
    overflow: hidden; // così i bordi dell'immagine non coprono il bordo arrotondato della card
    -webkit-box-shadow: 0px 0px 25px -10px rgba(0, 0, 0, 0.6);
    box-shadow: 0px 0px 25px -10px rgba(0, 0, 0, 0.6);
  }

  &__card:hover {
    cursor: pointer;
    border-color: var(--card-restaurant-border);

    .restaurants__name,
    .restaurants__typology {
      color: var(--title-color);
    }
  }

  .link {
    .restaurants__content {
      position: relative;
    }

    .restaurants__name {
      font-size: 17px;
      font-weight: bold;
      margin-left: 10px;
      color: var(--title-primary);
    }

    .restaurants__category {
      margin-left: 10px;
    }

    .restaurants__image {
      width: 100%;
      height: 200px;
      margin-bottom: 10px;
    }

    .restaurants__typology {
      font-weight: 700;
    }

    .restaurants__badge {
      position: absolute;
      top: 0.5em;
      left: 0.5em;
      padding: 0.1875em 0.3125em;
      color: #fff;
      font-weight: bold;
      border-radius: 0.3125em;
      background: linear-gradient(
        90deg,
        var(--badge-primary-color) 0%,
        var(--badge-secondary-color) 66%
      );
    }

    .restaurants__delivery {
      position: absolute;
      top: 14em;
      right: 1em;
      padding: 1em;
      color: var(--title-primary);
      font-size: 0.875em;
      font-weight: 700;
      border: 1px solid var(--divider);
      border-radius: 2.25rem;
      background: var(--background-primary);
    }
  }
}

@media screen and (min-width: 360px) {
  .restaurants__card {
    width: 100%;
  }
}

@media screen and (min-width: 480px) {
  .restaurants__card {
    width: calc((100% / 2) - 1.25rem);
  }
}

@media screen and (min-width: 768px) {
  .restaurants__card {
    width: calc((100% / 3) - 1.25rem);
  }
}

@media screen and (min-width: 1400px) {
  .restaurants__card {
    width: calc((100% / 4) - 1.25rem);
  }
}
</style>