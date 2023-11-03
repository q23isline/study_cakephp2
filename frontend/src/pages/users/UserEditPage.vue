<template>
  <div>
    <div class="users form">
      <UserForm :user-id="userId" />
    </div>
    <div class="actions">
      <h3>Actions</h3>
      <ul>
        <li><a @click="deleteView(userId)">Delete</a></li>
        <li><a href="/v1/users">List Users</a></li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { ElNotification } from "element-ui/types/notification";
import UserApi from "@/api/UserApi";
import UserForm from "@/organisms/users/UserEditForm.vue";

@Component({
  components: {
    UserForm,
  },
})
export default class UserEditPage extends Vue {
  @Prop({ default: "" })
  userId!: string;

  public $notify!: ElNotification;

  /**
   *1行削除
   * @param id
   */
  public async deleteView(id: string): Promise<void> {
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

      this.$router.push("/v1/users");
    }
  }
}
</script>
