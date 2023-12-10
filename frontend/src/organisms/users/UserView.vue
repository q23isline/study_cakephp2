<template>
  <dl>
    <dt>Id</dt>
    <dd>{{ user.data.id }}</dd>
    <dt>Username</dt>
    <dd>{{ user.data.username }}</dd>
    <dt>Password</dt>
    <dd>{{ user.data.password }}</dd>
    <dt>Role Name</dt>
    <dd>{{ user.data.roleName }}</dd>
    <dt>Name</dt>
    <dd>{{ user.data.name }}</dd>
    <dt>Created</dt>
    <dd>{{ toDateTimeString(user.data.created) }}</dd>
    <dt>Modified</dt>
    <dd>{{ toDateTimeString(user.data.modified) }}</dd>
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

  user: {
    data: User;
  } = {
    data: {
      id: "",
      username: "",
      password: "",
      roleName: "",
      name: "",
      created: new Date(),
      modified: new Date(),
    },
  };

  /**
   * yyyy/m/d HH:MM:SS 形式の文字列に変換する
   * @param dateTime 日付
   */
  toDateTimeString(dateTime: Date): string {
    return DateUtil.toDateTimeString(dateTime);
  }

  /**
   * ユーザー情報読み込み
   */
  private async load(): Promise<void> {
    const user = await UserApi.get(this.userId);
    this.user.data.id = user.data.id;
    this.user.data.username = user.data.username;
    this.user.data.password = user.data.password;
    this.user.data.roleName = user.data.roleName;
    this.user.data.name = user.data.name;
    this.user.data.created = new Date(user.data.created);
    this.user.data.modified = new Date(user.data.modified);
  }

  /**
   * 初期化
   */
  private async mounted(): Promise<void> {
    await this.load();
  }
}
</script>
