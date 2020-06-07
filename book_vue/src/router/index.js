import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../components/login.vue";
import Dashboard from "../components/dashboard/dashboard.vue";

Vue.use(VueRouter);

const routes = [
  { path: "/", name: "Home", component: Home},
  { path: "/login", name: "Login", component: Login},
  { path: "/dashboard", name: "Dashboard", component: Dashboard,
      children: [

      ]},
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../components/dashboard/dashboard.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
