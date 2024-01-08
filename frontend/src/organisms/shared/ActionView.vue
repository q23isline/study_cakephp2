<template>
  <div class="actions">
    <h3>Actions</h3>
    <ul>
      <template v-if="action === 'add'">
        <li v-if="actions.includes('list')">
          <router-link to="/v1/users">List</router-link>
        </li>
      </template>
      <template v-else-if="action === 'edit'">
        <li v-if="actions.includes('delete')">
          <a @click="deleteView(userId)">Delete</a>
        </li>
        <li v-if="actions.includes('list')">
          <router-link to="/v1/users">List</router-link>
        </li>
      </template>
      <template v-else-if="action === 'list'">
        <li v-if="actions.includes('add')">
          <router-link to="/v1/users/add">New</router-link>
        </li>
      </template>
      <template v-else-if="action === 'view'">
        <li v-if="actions.includes('edit')">
          <router-link :to="`/v1/users/edit/${userId}`">Edit</router-link>
        </li>
        <li v-if="actions.includes('delete')">
          <a @click="deleteView(userId)">Delete</a>
        </li>
        <li v-if="actions.includes('list')">
          <router-link to="/v1/users">List</router-link>
        </li>
        <li v-if="actions.includes('add')">
          <router-link to="/v1/users/add">New</router-link>
        </li>
      </template>
    </ul>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { ElNotification } from "element-ui/types/notification";
import { getModule } from "vuex-module-decorators";
import { PermissionStore } from "@/store/types/PermissionStore";
import PermissionApi from "@/api/PermissionApi";
import PermissionModule from "@/store/modules/PermissionModule";
import store from "@/store";
import UserApi from "@/api/UserApi";

@Component
export default class ActionView extends Vue {
  @Prop({ type: String, required: true })
  action!: string;

  @Prop({ type: String, required: true })
  functionKey!: string;

  // TODO: 画面遷移のリンクが user 固定になっているので可変にする
  @Prop({ type: String, default: "" })
  userId!: string;

  $notify!: ElNotification;
  actions: string[] = [];

  private permissionModule = getModule(PermissionModule, store);

  /**
   *1行削除
   * @param id
   */
  async deleteView(id: string): Promise<void> {
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

      this.$router.push("/v1/users");
    }
  }

  /**
   * 初期化
   */
  async mounted(): Promise<void> {
    let permissions = await this.allPermissions();
    if (!(this.functionKey in permissions)) {
      await this.load();
    }

    permissions = await this.allPermissions();
    this.actions = permissions[this.functionKey];
  }

  /**
   * 権限読み込み
   */
  private async load(): Promise<void> {
    const permission = await PermissionApi.get(this.functionKey);
    this.permissionModule.setPermission({
      functionKey: this.functionKey,
      arrowActions: permission.data,
    });
  }

  /**
   * すべての権限を取得する
   */
  private allPermissions(): PermissionStore {
    return this.permissionModule.getAllPermissions();
  }
}
</script>
