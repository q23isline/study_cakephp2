<template>
  <div class="menu-icons">
    <span><a href="/users/logout">ログアウト</a></span>
    <div class="menu-icon profile-icon">{{ user.name.slice(0, 1) }}</div>
    <span
      ><router-link :to="`/v1/users/view/${user.id}`">{{
        user.name
      }}</router-link></span
    >
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { User } from "@/models/User";
import UserApi from "@/api/UserApi";

@Component
export default class HeaderLoginUserView extends Vue {
  user = new User("-", "-", "-", "-", "-", new Date(), new Date());

  /**
   * 初期化
   */
  async mounted(): Promise<void> {
    await this.load();
  }

  /**
   * ユーザー情報読み込み
   */
  private async load(): Promise<void> {
    const user = await UserApi.getLoginUser();
    this.user = new User(
      user.data.id,
      user.data.username,
      user.data.password,
      user.data.roleName,
      user.data.name,
      new Date(user.data.created),
      new Date(user.data.modified)
    );
  }
}
</script>
