<template>
  <div class="outer-wrapper">
    <div class="inner-wrapper" v-if="allProducts[0] != 'connection failed.'">
      <Product
        v-for="(product, index) in allProducts"
        :key="index"
        :id="product[0]"
        :sku="product[1]"
        :name="product[2]"
        :price="product[3]"
        :attribute="product[4]"
      />
    </div>
    <div class="info-wrapper" v-else>
      <p class="info">Wow, it's pretty empty here!</p>
      <p class="info">Add something to database in 'Add' subpage, and</p>
      <p class="info">all of the items will be shown here!</p>
    </div>
  </div>
</template>
<script>
import Product from "../components/Product.vue";
import axios from "axios";
import { formStore } from "../main";
export default {
  components: {
    Product,
  },
  data() {
    return {
      allProducts: Array,
    };
  },
  computed: {
    changedRoute() {
      return formStore.changedRouteToMain;
    },
    deleteItems() {
      return formStore.getDelteItems;
    },
  },
  watch: {
    changedRoute() {
      if (formStore.getChangedRouteToMain) {
        this.selectFromDatabase();
      }
      formStore.setChangedRouteToMain(false);
    },
    deleteItems() {
      if (formStore.getDelteItems) {
        this.deleteFromDatabase();
      }
      formStore.setDeleteItems(false);
    },
  },
  methods: {
    async selectFromDatabase() {
      await axios
        .post(
          "https://scandiweb-test-stanislaw-bozych.000webhostapp.com/dbHandlerer.php",
          {
            request: 1,
          }
        )
        .then((response) => {
          this.allProducts = response.data;
        });
    },
    async deleteFromDatabase() {
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      let checkedInputValues = [];

      let i = 0;
      checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
          const hiddenInput = checkbox.parentElement.querySelector(
            'input[type="hidden"]'
          );
          checkedInputValues[i] = hiddenInput.value;
          i++;
        }
      });
      await axios
        .post(
          "https://scandiweb-test-stanislaw-bozych.000webhostapp.com/dbHandlerer.php",
          {
            request: 3,
            idArray: checkedInputValues,
          }
        )
        .then((response) => {
          if (response.data[0]) {
            this.selectFromDatabase();
            const checkboxesAfter = document.querySelectorAll('input[type="checkbox"]');
            for(let j = 0; j < checkboxesAfter.length; j++){
              checkboxesAfter[j].checked = false;
            }
          }
        });
    },
  },
  created() {
    this.selectFromDatabase();
  },
};
</script>
<style scoped>
.outer-wrapper {
  display: flex;
  justify-content: center;
  min-height: 500px;
}
.inner-wrapper {
  width: 90%;
  display: grid;
  gap: 40px;
  justify-items: center;
  grid-template-columns: 1fr 1fr 1fr;
  padding-top: 30px;
  padding-bottom: 50px;
}
.info-wrapper {
  text-align: center;
  padding-top: 100px;
}
.info {
  font-size: 25px;
  margin-bottom: 10px;
}
</style>
