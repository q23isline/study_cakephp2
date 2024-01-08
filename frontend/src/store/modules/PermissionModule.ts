import { Action, Module, Mutation, VuexModule } from "vuex-module-decorators";
import {
  PermissionStore,
  PermissionSetStore,
} from "@/store/types/PermissionStore";

@Module({ namespaced: true, name: "permission" })
export default class PermissionModule extends VuexModule {
  private permissions: PermissionStore = {};

  @Mutation
  private set(param: PermissionSetStore): void {
    // 引数は 1つでないと渡せないため、1つに要素を詰め込んで受け取る
    this.permissions[param.functionKey] = param.arrowActions;
  }

  @Action
  setPermission(param: PermissionSetStore): void {
    // 引数は 1つでないと渡せないため、1つに要素を詰め込んで受け取る
    this.set(param);
  }

  @Action
  getAllPermissions(): PermissionStore {
    return this.permissions;
  }
}
