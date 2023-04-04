<template>
  <div class="outer-wrapper">
    <div class="inner-wrapper">
      <form action="post" id="product_form">
        <div>SKU: <input type="text" id="sku" v-model="sku" /></div>
        <div>Name: <input type="text" id="name" v-model="name" /></div>
        <div>
          Price: <input type="number" min="0" id="price" v-model="price" />
        </div>
        <div>
          Type Switcher
          <select
            class="form-control"
            id="productType"
            v-model="selectedOption"
          >
            <option value="dvd">DVD</option>
            <option value="book">Book</option>
            <option value="furniture">Furniture</option>
          </select>
        </div>
        <div v-if="selectedOption == 'dvd'">
          Size (MB) <input type="number" min="0" id="size" v-model="size" />
          <p class="label">Size of the disc in megabytes.</p>
        </div>
        <div v-if="selectedOption == 'book'">
          Weight (KG) <input type="number" id="weight" v-model="weight" />
          <p class="label">Weight of the book in kilograms.</p>
        </div>
        <div v-if="selectedOption == 'furniture'">
          <div>
            Height (M)
            <input type="number" min="0" id="height" v-model="height" />
            <p class="label">Height of the furniture in meters.</p>
          </div>
          <div>
            Width (M) <input type="number" min="0" id="width" v-model="width" />
            <p class="label">Width of the furniture in meters.</p>
          </div>
          <div>
            Length (M)
            <input type="number" min="0" id="length" v-model="length" />
            <p class="label">Length of the furniture in meters.</p>
          </div>
        </div>
      </form>
      <div class="incorrect" v-if="showIncorrectDataNotification">
        <p>The data was filled incorrectly, or some fields are empty.</p>
        <p>Please fill the form correctly.</p>
      </div>
      <div class="duplicated" v-if="showDuplicatedSku">
        <p>An item with submited SKU number already exits in database.</p>
        <p>Please fill the form correctly.</p>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { formStore } from "../main";
export default {
  computed: {
    submitForm() {
      return formStore.getSubmitForm;
    },
  },
  watch: {
    submitForm() {
      if (formStore.getSubmitForm) {
        this.checkSku(this.sku);
      }
      formStore.setSubmitForm(false);
    },
  },
  data() {
    return {
      sku: "",
      name: "",
      price: "",
      selectedOption: "-",
      size: "",
      weight: "",
      height: "",
      width: "",
      length: "",
      showIncorrectDataNotification: false,
      showDuplicatedSku: false,
    };
  },
  methods: {
    addToDatabase(data) {
      this.showIncorrectDataNotification = false;
      this.showDuplicatedSku = false;
      axios.post(
        "https://scandiweb-test-stanislaw-bozych.000webhostapp.com/dbHandlerer.php",
        {
          request: 2,
          sku: data.sku,
          name: data.name,
          price: data.price,
          selectedOption: data.selectedOption,
          size: data.size,
          weight: data.weight,
          height: data.height,
          width: data.width,
          length: data.length,
        }
      );
      this.$router.push("/");
    },
    submit() {
      let data = {
        sku: this.sku,
        name: this.name,
        price: this.price,
        selectedOption: this.selectedOption,
        size: this.size,
        weight: this.weight,
        height: this.height,
        width: this.width,
        length: this.length,
      };
      if (this.sku != "" && this.name != "" && this.price != "") {
        if (this.selectedOption == "dvd") {
          if (this.size != "") {
            this.addToDatabase(data);
          } else this.showIncorrectDataNotification = true;
        } else if (this.selectedOption == "book") {
          if (this.weight != "") {
            this.addToDatabase(data);
          } else this.showIncorrectDataNotification = true;
        } else if (this.selectedOption == "furniture") {
          if (this.height != "" && this.width != "" && this.length != "") {
            this.addToDatabase(data);
          } else this.showIncorrectDataNotification = true;
        }
      } else this.showIncorrectDataNotification = true;
    },
    async checkSku(sku) {
      let doesSkuExist = false;
      await axios
        .post(
          "https://scandiweb-test-stanislaw-bozych.000webhostapp.com/dbHandlerer.php",
          {
            request: 4,
            sku: sku,
          }
        )
        .then(function (response) {
          if (response.data[0] == 0) {
            doesSkuExist = false;
          } else {
            doesSkuExist = true;
          }
        });
      if (!doesSkuExist) {
        this.submit();
      } else {
        this.showDuplicatedSku = true;
      }
    },
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
  display: flex;
  justify-content: left;
  flex-direction: column;
  font-size: 20px;
  margin-bottom: 25px;
}
input {
  margin: 25px;
}
.incorrect,
.duplicated {
  margin-top: 30px;
  font-size: 20px;
  color: red;
}
.label {
  margin-left: 20px;
  color: blue;
  font-size: 12px;
  margin-top: -20px;
}
</style>
