<template>
  <aside>
    <h2 class="title">Categorie</h2>
    <div class="wrapper">
      <div class="item" v-for="typology in typologies" :key="typology.id">
        <input
          type="checkbox"
          :name="typology.category"
          :id="typology.id"
          class="checkbox"
          @change="category_search(typology)"
        />
        <label :for="typology.id" class="checklabel">{{
          typology.category
        }}</label>
      </div>
    </div>
  </aside>
</template>

<script>
import { bus } from "../../front.js";
export default {
  name: "Aside",
  data() {
    return {
      typologies: [],
      checked: [],
      checkedName: [],
    };
  },
  created() {
    axios.get("/api/restaurants/typologies/all").then((response) => {
      this.typologies = response.data;
    });
  },
  methods: {
    category_search(typology) {
      if (this.checked.includes(typology.id)) {
        let index = this.checked.indexOf(typology.id);
        this.checked.splice(index, 1);
        this.checkedName.splice(index, 1);
      } else {
        this.checked.push(typology.id);
        this.checkedName.push(typology.category);
      }

      this.passChecked();
    },
    passChecked() {
      bus.$emit("passing_category", this.checked);
      bus.$emit("passing_category-name", this.checkedName);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";

aside {
  padding: 1rem 2rem;
  border-right: 2px solid var(--divider);
  font-family: "IBM Plex Sans", sans-serif;

  .title {
    color: var(--title-primary);
    font-size: 2.5em;
    font-weight: bold;
  }

  .checklabel {
    width: 100%;
    border: 1px solid var(--divider);
    background: var(--background-primary);
    border-radius: 0.5em;
    text-align: center;
    padding: 0.25em;
    font-size: 1.125em;
    color: var(--title-primary);
  }

  .checklabel:hover {
    cursor: pointer;
    color: var(--background-primary);
    background-color: var(--primary-color);

    .checklabel:checked {
      background-color: var(--primary-color);
    }
  }
  .checkbox {
    visibility: hidden;
  }
  .checkbox:checked + .checklabel {
    color: var(--background-primary);
    background-color: var(--primary-color);
  }
}

@media screen and (max-width: 992px) {
  .wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .item {
    margin-right: 20px;
  }
}
</style>