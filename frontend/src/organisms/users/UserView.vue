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

@Component
export default class UserView extends Vue {
  @Prop({ default: "" })
  userId!: string;

  public user: {
    data: User;
  } = {
    data: {
      id: "",
      username: "",
      password: "",
      roleName: "",
      name: "",
      created: new Date(),
      modified: new Date()
    },
  };

  /**
   * yyyy/m/d HH:MM:SS 形式の文字列に変換する
   * @param dateTime 日付
   */
  public toDateTimeString(dateTime: Date): string {
    return (
      dateTime.toLocaleDateString("ja-JP") +
      " " +
      dateTime.toLocaleTimeString("ja-JP")
    );
  }

  /**
   * ユーザー情報読み込み
   */
  private async load(): Promise<void> {
    try {
      this.user = await UserApi.findById(this.userId);
    } catch (error) {
      console.error(error);
    }
  }

  /**
   * 初期化
   */
  private async mounted(): Promise<void> {
    await this.load();
  }
}
</script>
