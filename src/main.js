import Vue from "vue";
import App from "./App.vue";
import router from "./router";

// Include our custom styles
import styles from './assets/scss/styles.scss';

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
