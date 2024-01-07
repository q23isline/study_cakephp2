<template>
  <div>
    <div class="table-condition">
      <el-select v-model="sortSelect.value" @change="changeSort">
        <el-option
          v-for="item in sortSelect.options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        >
        </el-option>
      </el-select>
      <el-select v-model="pageSizeSelect.value" @change="changePageSize">
        <el-option
          v-for="item in pageSizeSelect.options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        >
        </el-option>
      </el-select>
    </div>
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
    <div class="pagination">
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

<style>
.table-condition {
  text-align: right;
}
.pagination {
  text-align: center;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { ElNotification } from "element-ui/types/notification";
import { ListMetaResponse } from "@/models/types/ListMetaResponse";
import { User } from "@/models/User";
import UserApi from "@/api/UserApi";
import { UserApiListParam } from "@/models/types/UserApiParam";
import { DateUtil } from "@/utils/DateUtil";

@Component
export default class UserList extends Vue {
  page = 1;
  pageSize = 10;
  sort = "-username";
  sortSelect = {
    options: [
      {
        value: "+id",
        label: "Id 昇順",
      },
      {
        value: "-id",
        label: "Id 降順",
      },
      {
        value: "+username",
        label: "Username 昇順",
      },
      {
        value: "-username",
        label: "Username 降順",
      },
      {
        value: "+password",
        label: "Password 昇順",
      },
      {
        value: "-password",
        label: "Password 降順",
      },
      {
        value: "+roleName",
        label: "Role 昇順",
      },
      {
        value: "-roleName",
        label: "Role 降順",
      },
      {
        value: "+name",
        label: "Name 昇順",
      },
      {
        value: "-name",
        label: "Name 降順",
      },
      {
        value: "+created",
        label: "Created 昇順",
      },
      {
        value: "-created",
        label: "Created 降順",
      },
      {
        value: "+modified",
        label: "Modified 昇順",
      },
      {
        value: "-modified",
        label: "Modified 降順",
      },
    ],
    value: "-username",
  };

  pageSizeSelect = {
    options: [
      {
        value: 10,
        label: "10件",
      },
      {
        value: 20,
        label: "20件",
      },
      {
        value: 50,
        label: "50件",
      },
    ],
    value: 10,
  };

  users: {
    meta: ListMetaResponse;
    data: User[];
  } = {
    meta: {
      page: 1,
      pageSize: 10,
      totalCount: 0,
    },
    data: [],
  };

  $notify!: ElNotification;

  /**
   * yyyy/m/d HH:MM:SS 形式の文字列に変換する
   * @param dateTime 日付
   */
  toDateTimeString(dateTime: Date): string {
    return DateUtil.toDateTimeString(dateTime);
  }

  /**
   * ソート条件を変更する
   * @param sort
   */
  async changeSort(sort: string): Promise<void> {
    this.sort = sort;
    await this.load();
  }

  /**
   * 表示件数を変更する
   * @param pageSize
   */
  async changePageSize(pageSize: number): Promise<void> {
    this.pageSize = pageSize;
    await this.load();
  }

  /**
   * ページングを変更する
   * @param page
   */
  async changePage(page: number): Promise<void> {
    this.page = page;
    await this.load();
  }

  /**
   * 詳細画面へリダイレクト
   * @param row
   */
  redirectView(row: { id: string }): void {
    this.$router.push(`/v1/users/view/${row.id}`);
  }

  /**
   * 編集画面へリダイレクト
   * @param id
   */
  redirectEdit(id: string): void {
    this.$router.push(`/v1/users/edit/${id}`);
  }

  /**
   *1行削除
   * @param id
   */
  async deleteRow(id: string): Promise<void> {
    const isConfirmed = window.confirm(
      `Are you sure you want to delete # ${id}?`
    );
    if (isConfirmed) {
      await UserApi.delete(id);

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
   * 初期化
   */
  async mounted(): Promise<void> {
    await this.load();
  }

  /**
   * ユーザー情報読み込み
   */
  private async load(): Promise<void> {
    const params = new UserApiListParam(this.page, this.pageSize, this.sort);
    const users = await UserApi.getList(params);
    this.users.meta.page = users.meta.page;
    this.users.meta.pageSize = users.meta.pageSize;
    this.users.meta.totalCount = users.meta.totalCount;
    this.users.data = users.data.map((user) => {
      return new User(
        user.id,
        user.username,
        user.password,
        user.roleName,
        user.name,
        new Date(user.created),
        new Date(user.modified)
      );
    });
  }
}
</script>
