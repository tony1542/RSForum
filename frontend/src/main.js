import Vue from "vue";
import App from "./App.vue";
import router from "./router";

// Bootstrap includes
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// Custom directives
import clickOutside from "./helpers/Directives/clickOutside";

Vue.directive('click-outside', clickOutside);

new Vue({
    router,
    render: (h) => h(App)
}).$mount("#app");
