<template>
  <div>
    <div class="users index">
      <h2>Users</h2>
      <UserList />
    </div>
    <div class="actions">
      <h3>Actions</h3>
      <ul>
        <li><a href="/v1/users/add">New User</a></li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import UserList from "@/organisms/users/UserList.vue";

@Component({
  components: {
    UserList,
  },
})
export default class UserListPage extends Vue {}
</script>
