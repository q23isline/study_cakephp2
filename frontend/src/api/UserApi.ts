import { AppApi } from "@/api/AppApi";
import User from "@/models/User";

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
    readonly meta: { page: number; pageSize: number; totalCount: number };
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
      return new User(
        user.id,
        user.username,
        user.password,
        user.roleName,
        user.name,
        new Date(user.created),
        new Date(user.modified)
      );
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
      data: new User(
        res.data.data.id,
        res.data.data.username,
        res.data.data.password,
        res.data.data.roleName,
        res.data.data.name,
        new Date(res.data.data.created),
        new Date(res.data.data.modified)
      ),
    };
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
