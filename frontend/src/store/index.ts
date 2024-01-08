import Vue from "vue";
import Vuex from "vuex";
import PermissionModule from "@/store/modules/PermissionModule";

Vue.use(Vuex);

export default new Vuex.Store({
  strict: process.env.NODE_ENV === "development",
  modules: {
    permission: PermissionModule,
  },
});
