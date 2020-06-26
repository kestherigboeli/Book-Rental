/* eslint-disable */
import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../components/login.vue";
import Dashboard from "../components/dashboard/dashboard.vue";
import AdminDashboard from "../components/dashboard/adminDashboard.vue";
import AdminEditUser from "../components/dashboard/adminEditUser.vue";
import store from '@/store'

Vue.use(VueRouter);

const routes = [
  { path: "/", name: "Home", component: Home },
    {
        path: "/login",
        name: "Login",
        component: Login,
        beforeEnter: (to, from, next) => {
            if (store.getters['auth/authenticated']) {
                return next({
                    name: 'dashboard'
                });
            }

            next()
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/authenticated']) {
                return next({
                    name: 'Login'
                });
            }

            next()
        },
        children: [
            {
                path: 'users',
                component: AdminDashboard
            },
            {
                path: 'user/:user_id',
                component: AdminEditUser
            }],
    },
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../components/dashboard/dashboard.vue"
      )
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
