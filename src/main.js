import Vue from "vue";
import App from "./App.vue";
import router from "./router";

// Bootstrap includes
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

// Font-awesome includes
/** @see https://fontawesome.com/docs/web/use-with/vue/add-icons */
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMoon, faSun } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Include the icons we'd like to use
library.add(faMoon, faSun);

// Add the font awesome icon component
Vue.component('FontAwesomeIcon', FontAwesomeIcon);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
