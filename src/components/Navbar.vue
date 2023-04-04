<template>
  <div class="navbar-wrapper">
    <div class="content">
      <div class="left">
        <p class="title">{{ this.currentTitle }}</p>
      </div>
      <div class="right">
        <button @click="btn1Function">{{ this.firstBtnText }}</button>
        <button @click="btn2Function" id="delete-product-btn">
          {{ this.secondBtnText }}
        </button>
      </div>
    </div>
    <Line />
  </div>
</template>
<script>
import { formStore } from "../main";
import Line from "./Line.vue";

export default {
  components: {
    Line,
  },
  methods: {
    btn1Function() {
      if (this.$route.name == "ProductList") {
        this.$router.push("/addProducts");
      } else {
        formStore.setSubmitForm(true);
      }
    },
    btn2Function() {
      if (this.$route.name == "ProductList") {
        formStore.setDeleteItems(true);
      } else {
        this.$router.push("/");
      }
    },
  },
  computed: {
    currentTitle() {
      if (this.$route.name == "ProductList") {
        return "Product List";
      } else return "Product Add";
    },
    firstBtnText() {
      if (this.$route.name == "ProductList") {
        return "ADD";
      } else return "Save";
    },
    secondBtnText() {
      if (this.$route.name == "ProductList") {
        return "MASS DELETE";
      } else return "CANCEL";
    },
  },
};
</script>
<style lang="css" scoped>
.navbar-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.content {
  height: 50px;
  display: flex;
  width: 90%;
  margin-bottom: 5px;
}
.right,
.left {
  display: flex;
  align-items: end;
  width: 100%;
  height: 100%;
}
.right {
  justify-content: right;
}
button {
  font-size: 25px;
  padding: 2px 10px;
  margin-right: 30px;
  border: black 1px solid;
  background-color: white;
  border-radius: 5px;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  text-transform: uppercase;
}
.title {
  font-size: 35px;
  padding-left: 15px;
}
</style>
