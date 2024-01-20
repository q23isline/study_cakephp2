<template>
  <div>
    <div class="users view">
      <h2>ユーザー詳細</h2>
      <UserView :user-id="userId" />
    </div>
    <ActionView functionKey="user" action="view" :user-id="userId" />
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import ActionView from "@/organisms/shared/ActionView.vue";
import UserView from "@/organisms/users/UserView.vue";

@Component({
  components: {
    ActionView,
    UserView,
  },
})
export default class UserPage extends Vue {
  @Prop({ default: "" })
  userId!: string;
}
</script>
