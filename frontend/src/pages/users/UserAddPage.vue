<template>
  <div>
    <div class="users form">
      <UserForm />
    </div>
    <div class="actions">
      <h3>Actions</h3>
      <ul>
        <li><router-link to="/v1/users">List Users</router-link></li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import UserForm from "@/organisms/users/UserAddForm.vue";

@Component({
  components: {
    UserForm,
  },
})
export default class UserAddPage extends Vue {}
</script>
