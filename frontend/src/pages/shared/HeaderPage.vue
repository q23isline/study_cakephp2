<template>
  <div id="header">
    <div class="header-inner">
      <h1 class="header-logo">
        <a href="https://cakephp.org"
          >CakePHP: the rapid development php framework</a
        >
      </h1>
      <HeaderLoginUserView />
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import HeaderLoginUserView from "@/organisms/shared/HeaderLoginUserView.vue";

@Component({
  components: {
    HeaderLoginUserView,
  },
})
export default class HeaderPage extends Vue {}
</script>
