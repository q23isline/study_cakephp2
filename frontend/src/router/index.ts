import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
  {
    path: "/v1/users",
    name: "UserListPage",
    component: () => import("../pages/users/UserListPage.vue"),
  },
  {
    path: "/v1/users/view/:userId([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})",
    name: "UserPage",
    component: () => import("../pages/users/UserPage.vue"),
    props: true,
  },
  {
    path: "/v1/users/add",
    name: "UserAddPage",
    component: () => import("../pages/users/UserAddPage.vue"),
  },
  {
    path: "/v1/users/edit/:userId([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})",
    name: "UserEditPage",
    component: () => import("../pages/users/UserEditPage.vue"),
    props: true,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
