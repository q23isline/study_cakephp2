<template>
  <el-form ref="form" :model="user" :rules="rules" v-loading="loading">
    <fieldset>
      <legend>ユーザー追加</legend>
      <el-form-item
        label="アカウント名"
        prop="username"
        :error="errorMessages.username"
      >
        <el-input
          v-model="user.username"
          maxlength="50"
          id="username"
        ></el-input>
      </el-form-item>
      <el-form-item
        label="パスワード"
        prop="password"
        :error="errorMessages.password"
      >
        <el-input
          type="password"
          v-model="user.password"
          maxlength="50"
          id="password"
          show-password
        ></el-input>
      </el-form-item>
      <el-form-item
        label="権限"
        prop="roleName"
        :error="errorMessages.roleName"
      >
        <el-select v-model="user.roleName" placeholder="Select" id="roleName">
          <el-option
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          >
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="氏名" prop="name" :error="errorMessages.name">
        <el-input v-model="user.name" maxlength="50" id="name"></el-input>
      </el-form-item>
    </fieldset>
    <el-form-item>
      <el-button type="primary" @click="onsubmit" :disabled="!validationResult"
        >登録</el-button
      >
    </el-form-item>
  </el-form>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { ElForm, ValidateCallback } from "element-ui/types/form";
import { ElNotification } from "element-ui/types/notification";
import UserApi from "@/api/UserApi";
import { ValidateError } from "@/exception/ValidateError";

@Component
export default class UserForm extends Vue {
  user = {
    username: "",
    password: "",
    roleName: "admin",
    name: "",
  };

  $refs!: { form: ElForm };
  $notify!: ElNotification;
  rules = {
    username: [
      { required: true, message: "この項目は必須入力です。", trigger: "blur" },
      {
        pattern: /^[a-z0-9]+$/i,
        message: "この項目は英字と数字だけしか使えません。",
        trigger: "blur",
      },
      { max: 50, message: "この項目は50文字までです。", trigger: "blur" },
    ],
    password: [
      { required: true, message: "この項目は必須入力です。", trigger: "blur" },
      {
        pattern: /^[a-z0-9]+$/i,
        message: "この項目は英字と数字だけしか使えません。",
        trigger: "blur",
      },
      { max: 50, message: "この項目は50文字までです。", trigger: "blur" },
    ],
    roleName: [
      { required: true, message: "この項目は必須入力です。", trigger: "blur" },
      { type: "enum", enum: ["admin", "author"] },
    ],
    name: [
      { required: true, message: "この項目は必須入力です。", trigger: "blur" },
      { max: 50, message: "この項目は50文字までです。", trigger: "blur" },
    ],
  };

  options = [
    {
      value: "admin",
      label: "Admin",
    },
    {
      value: "author",
      label: "Author",
    },
  ];

  validationResult = false;
  loading = false;
  errorMessages: { [key: string]: string } = {};

  beforeUpdate(): void {
    this.updateValidationResult();
  }

  async onsubmit(): Promise<void> {
    await this.$refs.form.validate(async (valid: boolean) => {
      if (valid) {
        try {
          this.loading = true;
          await UserApi.save({
            username: this.user.username,
            password: this.user.password,
            roleName: this.user.roleName,
            name: this.user.name,
          });
          this.loading = false;

          this.$notify({
            title: "登録しました",
            message: "",
            type: "success",
            duration: 2000,
          });

          this.$router.push("/v1/users");
        } catch (e) {
          if (e instanceof ValidateError) {
            this.loading = false;
            this.$notify({
              title: "エラーがあります",
              message: "",
              type: "error",
              duration: 2000,
            });

            // 2回目のエラーでメッセージが消えてしまうため、消えないように初期化した後少し待つ必要がある
            this.errorMessages = {};
            await this.sleep(10);

            e.errors.forEach((apiError: { field: string; reason: string }) =>
              this.$set(this.errorMessages, apiError.field, apiError.reason)
            );
          }
        }
      }
    });
  }

  private updateValidationResult(): void {
    const callback: ValidateCallback = (isValid) =>
      (this.validationResult = isValid);

    this.$refs.form.validate(callback);
  }

  /**
   * 待機する
   * @param ms
   */
  private async sleep(ms: number): Promise<void> {
    return new Promise((resolve) => window.setTimeout(resolve, ms));
  }
}
</script>
