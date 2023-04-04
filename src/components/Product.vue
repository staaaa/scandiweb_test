<template>
  <div class="wrapper">
    <div class="checkbox">
      <input type="checkbox" class="delete-checkbox" v-model="isChecked" />
      <input type="hidden" class="hidden" :value="id" />
    </div>
    <p class="sku">SKU: {{ this.sku }}</p>
    <p class="name">NAME: {{ this.name }}</p>
    <p class="price">PRICE: {{ this.price }} $</p>
    <p class="attribute">{{ this.attribute }}</p>
  </div>
</template>

<script>
export default {
  props: {
    id: String,
    sku: String,
    name: String,
    price: String,
    attribute: String,
  },
  data() {
    return {
      isPickedToDelete: false,
    };
  },
  watch: {
    isChecked(value) {
      const hiddenInput = document.querySelector(".hidden");
      if (value) {
        hiddenInput.classList.add("ready_to_delete");
      } else {
        hiddenInput.classList.remove("ready_to_delete");
      }
    },
  },
};
</script>

<style scoped>
.wrapper {
  height: 150px;
  width: 75%;
  border: 2px solid black;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 20px;
}
.checkbox {
  width: 100%;
  padding: 5px;
}
.delete-checkbox {
  width: 20px;
  height: 20px;
  border: 1px solid black;
}
.ready_to_delete {
  background-color: red;
}
</style>
