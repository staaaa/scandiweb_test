import { defineStore } from "pinia";

export const useFormStore = defineStore("form", {
  state: () => ({
    submitForm: false,
    delteItems: false,
    changedRouteToMain: false,
  }),
  getters: {
    getSubmitForm: (state) => state.submitForm,
    getDelteItems: (state) => state.delteItems,
    getChangedRouteToMain: (state) => state.changedRouteToMain,
  },
  actions: {
    setSubmitForm(payload) {
      this.submitForm = payload;
    },
    setDeleteItems(payload) {
      this.delteItems = payload;
    },
    setChangedRouteToMain(payload) {
      this.changedRouteToMain = payload;
    },
  },
});
