<template>
  <div>
    <el-table :data="users.data" @row-click="redirectView">
      <el-table-column label="Id" prop="id"></el-table-column>
      <el-table-column label="Username" prop="username"></el-table-column>
      <el-table-column label="Password" prop="password"></el-table-column>
      <el-table-column label="Role" prop="roleName"></el-table-column>
      <el-table-column label="Name" prop="name"></el-table-column>
      <el-table-column label="Created" prop="created">
        <template v-slot="scope">
          {{ toDateTimeString(scope.row.created) }}
        </template>
      </el-table-column>
      <el-table-column label="Modified" prop="modified">
        <template v-slot="scope">
          {{ toDateTimeString(scope.row.modified) }}
        </template>
      </el-table-column>
      <el-table-column label="Actions">
        <template v-slot="scope">
          <el-button
            icon="el-icon-edit-outline"
            @click.stop="redirectEdit(scope.row.id)"
          ></el-button>
          <el-button
            icon="el-icon-delete-solid"
            @click.stop="deleteRow(scope.row.id)"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>
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
   * 詳細画面へリダイレクト
   * @param row
   */
  public redirectView(row: { id: string }): void {
    this.$router.push(`/v1/users/view/${row.id}`);
  }

  /**
   * 編集画面へリダイレクト
   * @param id
   */
  public redirectEdit(id: string): void {
    this.$router.push(`/v1/users/edit/${id}`);
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
