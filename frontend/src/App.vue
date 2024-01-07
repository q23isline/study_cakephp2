<template>
  <div id="app">
    <div id="container">
      <HeaderPage />
      <div id="content">
        <div id="nav">
          <router-link to="/">Home</router-link> |
          <router-link to="/about">About</router-link> |
          <a href="/v1/users">Vue Users</a> |
          <a href="/users">CakePHP Users</a>
        </div>
        <router-view />
      </div>
      <div id="footer"></div>
    </div>
  </div>
</template>

<style>
#app {
  text-align: center;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import HeaderPage from "@/pages/shared/HeaderPage.vue";

@Component({
  components: {
    HeaderPage,
  },
})
export default class App extends Vue {}
</script>
