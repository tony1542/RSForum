import Vue from "vue";
import App from "./App.vue";
import router from "./router";

// TODO include sass file in here

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
