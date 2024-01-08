<template>
  <div>
    <div class="users form">
      <UserForm />
    </div>
    <ActionView functionKey="user" action="add" />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import ActionView from "@/organisms/shared/ActionView.vue";
import UserForm from "@/organisms/users/UserAddForm.vue";

@Component({
  components: {
    ActionView,
    UserForm,
  },
})
export default class UserAddPage extends Vue {}
</script>
