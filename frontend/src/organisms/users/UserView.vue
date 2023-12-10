<template>
  <dl>
    <dt>Id</dt>
    <dd>{{ user.id }}</dd>
    <dt>Username</dt>
    <dd>{{ user.username }}</dd>
    <dt>Password</dt>
    <dd>{{ user.password }}</dd>
    <dt>Role Name</dt>
    <dd>{{ user.roleName }}</dd>
    <dt>Name</dt>
    <dd>{{ user.name }}</dd>
    <dt>Created</dt>
    <dd>{{ toDateTimeString(user.created) }}</dd>
    <dt>Modified</dt>
    <dd>{{ toDateTimeString(user.modified) }}</dd>
  </dl>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { User } from "@/models/User";
import UserApi from "@/api/UserApi";
import { DateUtil } from "@/utils/DateUtil";

@Component
export default class UserView extends Vue {
  @Prop({ default: "" })
  userId!: string;
  user = new User("", "", "", "", "", new Date(), new Date());

  /**
   * yyyy/m/d HH:MM:SS 形式の文字列に変換する
   * @param dateTime 日付
   */
  toDateTimeString(dateTime: Date): string {
    return DateUtil.toDateTimeString(dateTime);
  }

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
    const user = await UserApi.get(this.userId);
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
