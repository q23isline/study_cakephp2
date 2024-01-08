<template>
  <div>
    <div class="users form">
      <UserForm :user-id="userId" />
    </div>
    <ActionView functionKey="user" action="edit" :user-id="userId" />
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import ActionView from "@/organisms/shared/ActionView.vue";
import UserForm from "@/organisms/users/UserEditForm.vue";

@Component({
  components: {
    ActionView,
    UserForm,
  },
})
export default class UserEditPage extends Vue {
  @Prop({ default: "" })
  userId!: string;
}
</script>
