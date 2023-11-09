import { AppApi } from "@/api/AppApi";
import { User } from "@/models/User";
import { ListMeta } from "@/models/ListMeta";

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
    readonly meta: ListMeta;
    readonly data: User[];
  }> {
    const res = await AppApi.get("/api/v1/users", {
      params: {
        page: page,
        pageSize: pageSize,
        sort: sort,
      },
    });
    const users = res.data.data.map((user: User) => {
      return {
        id: user.id,
        username: user.username,
        password: user.password,
        roleName: user.roleName,
        name: user.name,
        created: new Date(user.created),
        modified: new Date(user.modified)
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
  public async findById(id: string): Promise<{ readonly data: User }> {
    const res = await AppApi.get(`/api/v1/users/${id}`);

    return {
      data: {
        id: res.data.data.id,
        username: res.data.data.username,
        password: res.data.data.password,
        roleName: res.data.data.roleName,
        name: res.data.data.name,
        created: new Date(res.data.data.created),
        modified: new Date(res.data.data.modified)
      }
    };
  }

  /**
   * ユーザー追加
   * @param data
   */
  public async save(data: {
    username: string;
    password: string;
    roleName: string;
    name: string;
  }): Promise<void> {
    await AppApi.post(`/api/v1/users`, {
      username: data.username,
      password: data.password,
      roleName: data.roleName,
      name: data.name,
    });
  }

  /**
   * ユーザー更新
   * @param data
   */
  public async update(data: {
    id: string;
    username: string;
    password: string;
    roleName: string;
    name: string;
  }): Promise<void> {
    await AppApi.put(`/api/v1/users/${data.id}`, {
      username: data.username,
      password: data.password,
      roleName: data.roleName,
      name: data.name,
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
