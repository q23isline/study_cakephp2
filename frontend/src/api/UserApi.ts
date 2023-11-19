import { AxiosError } from "axios";
import { AppApi } from "@/api/AppApi";
import {
  UserApiSaveParam,
  UserApiUpdateParam,
} from "@/api/params/UserApiParam";
import { UserApiUserReturn } from "@/api/returns/UserApiReturn";
import { ListMetaReturn } from "@/api/returns/ListMetaReturn";
import ValidateError from "@/exception/ValidateError";

class UserApi {
  /**
   * ユーザー情報取得
   * @param page
   * @param pageSize
   * @param sort
   */
  public async getList(
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
    }).catch((e: AxiosError) => {
      // link https://axios-http.com/ja/docs/handling_errors
      if (e.response) {
        // リクエストが行われ、サーバーは 2xx の範囲から外れるステータスコードで応答しました
        console.error(e.response.data);
        console.error(e.response.status);
        console.error(e.response.headers);
      } else if (e.request) {
        // リクエストは行われましたが、応答がありませんでした
        console.error(e.request);
      } else {
        // エラーをトリガーしたリクエストの設定中に何かが発生しました
        console.error("Error", e.message);
      }

      console.error(e.config);
      throw e;
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
  public async get(id: string): Promise<{ readonly data: UserApiUserReturn }> {
    const res = await AppApi.get(`/api/v1/users/${id}`).catch(
      (e: AxiosError) => {
        if (e.response) {
          console.error(e.response.data);
          console.error(e.response.status);
          console.error(e.response.headers);
        } else if (e.request) {
          console.error(e.request);
        } else {
          console.error("Error", e.message);
        }

        console.error(e.config);
        throw e;
      }
    );

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
    }).catch((e: AxiosError) => {
      if (e.response) {
        if (e.response.status === 400) {
          const apiError = new ValidateError(
            e.response.data.error.message,
            e.response.data.error.errors
          );

          throw apiError;
        } else {
          console.error(e.response.data);
          console.error(e.response.status);
          console.error(e.response.headers);
        }
      } else if (e.request) {
        console.error(e.request);
      } else {
        console.error("Error", e.message);
      }

      console.error(e.config);
      throw e;
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
    }).catch((e: AxiosError) => {
      if (e.response) {
        if (e.response.status === 400) {
          const apiError = new ValidateError(
            e.response.data.error.message,
            e.response.data.error.errors
          );

          throw apiError;
        } else {
          console.error(e.response.data);
          console.error(e.response.status);
          console.error(e.response.headers);
        }
      } else if (e.request) {
        console.error(e.request);
      } else {
        console.error("Error", e.message);
      }

      console.error(e.config);
      throw e;
    });
  }

  /**
   * ユーザー削除
   * @param id
   */
  public async delete(id: string): Promise<void> {
    await AppApi.delete(`/api/v1/users/${id}`).catch((e: AxiosError) => {
      if (e.response) {
        console.error(e.response.data);
        console.error(e.response.status);
        console.error(e.response.headers);
      } else if (e.request) {
        console.error(e.request);
      } else {
        console.error("Error", e.message);
      }

      console.error(e.config);
      throw e;
    });
  }
}

export default new UserApi();
