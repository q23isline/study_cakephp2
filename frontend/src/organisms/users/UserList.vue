<template>
  <div>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th>Id</th>
          <th>Username</th>
          <th>Password</th>
          <th>Role Name</th>
          <th>Name</th>
          <th>Created</th>
          <th>Modified</th>
          <th class="actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="user in users.data">
          <tr :user="user" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.password }}</td>
            <td>{{ user.roleName }}</td>
            <td>{{ user.name }}</td>
            <td>{{ toDateTimeString(user.created) }}</td>
            <td>{{ toDateTimeString(user.modified) }}</td>
            <td class="actions">
              <router-link :to="`/v1/users/view/${user.id}`">View</router-link>
              <router-link :to="`/v1/users/edit/${user.id}`">Edit</router-link>
              <a @click="deleteRow(user.id)">Delete</a>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <div>
      <el-pagination
        background
        layout="prev, pager, next"
        :total="users.meta.totalCount"
        :page-size="users.meta.pageSize"
        @current-change="changePage"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { ElNotification } from "element-ui/types/notification";
import User from "@/models/User";
import UserApi from "@/api/UserApi";

@Component
export default class UserList extends Vue {
  public page = 1;
  public pageSize = 10;
  public sort = "-username";
  public users: {
    meta: { page: number; pageSize: number; totalCount: number };
    data: User[];
  } = {
    meta: {
      page: 1,
      pageSize: 10,
      totalCount: 0,
    },
    data: [],
  };

  public $notify!: ElNotification;

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
   * ページングを変更する
   * @param page
   */
  public async changePage(page: number): Promise<void> {
    this.page = page;
    await this.load();
  }

  /**
   *1行削除
   * @param id
   */
  public async deleteRow(id: string): Promise<void> {
    const isConfirmed = window.confirm(
      `Are you sure you want to delete # ${id}?`
    );
    if (isConfirmed) {
      try {
        await UserApi.delete(id);
      } catch (error) {
        console.error(error);
      }

      this.$notify({
        title: "削除しました",
        message: "",
        type: "success",
        duration: 2000,
      });

      await this.load();
    }
  }

  /**
   * ユーザー情報読み込み
   */
  private async load(): Promise<void> {
    try {
      this.users = await UserApi.find(this.page, this.pageSize, this.sort);
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
