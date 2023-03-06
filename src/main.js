import App from "./App.vue";
import router from "./router";
import {createApp} from 'vue'
import Vue from "vue";
import store from './store'

// Bootstrap includes
// import "bootstrap";
// import "bootstrap/dist/css/bootstrap.min.css";

// Custom directives
// import clickOutside from "./helpers/Directives/clickOutside";

// Vue.directive('click-outside', clickOutside);

// new Vue({
//   router,
//   render: (h) => h(App)
// }).$mount("#app");

const app = Vue.createApp(App)
app.use(router)
// app.use(store)
app.mount('#app')
// createApp(App)
//     .use(store)
//     .use(router)
//     .mount('#app')
