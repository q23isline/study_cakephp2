import { AppApi } from "@/api/AppApi";
import {
  UserApiSaveParam,
  UserApiUpdateParam,
} from "@/api/params/UserApiParam";
import { UserApiUserReturn } from "@/api/returns/UserApiReturn";
import { ListMetaReturn } from "@/api/returns/ListMetaReturn";

class UserApi {
  /**
   * ユーザー情報取得
   * @param page
   * @param pageSize
   * @param sort
   */
  public async find(
    page = 1,
    pageSize = 10,
    sort = "-username"
  ): Promise<{
    readonly meta: ListMetaReturn;
    readonly data: UserApiUserReturn[];
  }> {
    const res = await AppApi.get("/api/v1/users", {
      params: {
        page: page,
        pageSize: pageSize,
        sort: sort,
      },
    });
    const users = res.data.data.map((user: UserApiUserReturn) => {
      return {
        id: user.id,
        username: user.username,
        password: user.password,
        roleName: user.roleName,
        name: user.name,
        created: new Date(user.created),
        modified: new Date(user.modified),
      };
    });

    return {
      meta: {
        page: res.data.meta.page,
        pageSize: res.data.meta.pageSize,
        totalCount: res.data.meta.totalCount,
      },
      data: users,
    };
  }

  /**
   * ユーザー詳細取得
   * @param id
   */
  public async findById(
    id: string
  ): Promise<{ readonly data: UserApiUserReturn }> {
    const res = await AppApi.get(`/api/v1/users/${id}`);

    return {
      data: {
        id: res.data.data.id,
        username: res.data.data.username,
        password: res.data.data.password,
        roleName: res.data.data.roleName,
        name: res.data.data.name,
        created: new Date(res.data.data.created),
        modified: new Date(res.data.data.modified),
      },
    };
  }

  /**
   * ユーザー追加
   * @param param
   */
  public async save(param: UserApiSaveParam): Promise<void> {
    await AppApi.post(`/api/v1/users`, {
      username: param.username,
      password: param.password,
      roleName: param.roleName,
      name: param.name,
    });
  }

  /**
   * ユーザー更新
   * @param param
   */
  public async update(param: UserApiUpdateParam): Promise<void> {
    await AppApi.put(`/api/v1/users/${param.id}`, {
      username: param.username,
      password: param.password,
      roleName: param.roleName,
      name: param.name,
    });
  }

  /**
   * ユーザー削除
   * @param id
   */
  public async delete(id: string): Promise<void> {
    await AppApi.delete(`/api/v1/users/${id}`);
  }
}

export default new UserApi();
