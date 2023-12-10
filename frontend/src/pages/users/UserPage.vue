<template>
  <div>
    <div class="users view">
      <h2>User</h2>
      <UserView :user-id="userId" />
    </div>
    <div class="actions">
      <h3>Actions</h3>
      <ul>
        <li>
          <router-link :to="`/v1/users/edit/${userId}`">Edit</router-link>
        </li>
        <li><a @click="deleteView(userId)">Delete</a></li>
        <li><a href="/v1/users">List Users</a></li>
        <li><a href="/v1/users/add">New User</a></li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { ElNotification } from "element-ui/types/notification";
import UserView from "@/organisms/users/UserView.vue";
import UserApi from "@/api/UserApi";

@Component({
  components: {
    UserView,
  },
})
export default class UserPage extends Vue {
  @Prop({ default: "" })
  userId!: string;

  $notify!: ElNotification;

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
}
</script>
