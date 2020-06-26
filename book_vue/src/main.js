import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
import VueSweetalert2 from "vue-sweetalert2";

require("@/store/subscriber");

// Boostrap 4
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";
import "sweetalert2/dist/sweetalert2.min.css";

axios.defaults.baseURL = "http://127.0.0.1:8000/api";

Vue.config.productionTip = false;
Vue.use(VueSweetalert2);

store.dispatch("auth/attempt", localStorage.getItem("token"));

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
