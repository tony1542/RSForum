import App from "./App.vue";
import router from "./router";
import {createApp} from 'vue'
import store from './store'

// Custom directives
// import clickOutside from "./helpers/Directives/clickOutside";

// Vue.directive('click-outside', clickOutside);

const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')