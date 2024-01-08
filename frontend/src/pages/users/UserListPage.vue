<template>
  <div>
    <div class="users index">
      <h2>Users</h2>
      <UserList />
    </div>
    <ActionView functionKey="user" action="list" />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import ActionView from "@/organisms/shared/ActionView.vue";
import UserList from "@/organisms/users/UserList.vue";

@Component({
  components: {
    ActionView,
    UserList,
  },
})
export default class UserListPage extends Vue {}
</script>
