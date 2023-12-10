import { AxiosError } from "axios";
import { AppApi } from "@/api/AppApi";
import { ListMetaResponse } from "@/models/types/ListMetaResponse";
import { UserApiListParam } from "@/models/types/UserApiParam";
import { ValidateError } from "@/exception/ValidateError";

type UserApiSaveParam = {
  username: string;
  password: string;
  roleName: string;
  name: string;
};

type UserApiUpdateParam = {
  id: string;
  username: string;
  password: string;
  roleName: string;
  name: string;
};

type UserApiListResponse = {
  data: UserApiDataResponse[];
  meta: ListMetaResponse;
};

type UserApiGetResponse = {
  data: UserApiDataResponse;
};

type UserApiDataResponse = {
  id: string;
  username: string;
  password: string;
  roleName: string;
  name: string;
  created: string;
  modified: string;
};

class UserApi {
  /**
   * ユーザー情報取得
   * @param params
   */
  async getList(params: UserApiListParam): Promise<UserApiListResponse> {
    const res = await AppApi.get<UserApiListResponse>("/api/v1/users", {
      params: params,
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

    return res.data;
  }

  /**
   * ユーザー詳細取得
   * @param id
   */
  async get(id: string): Promise<UserApiGetResponse> {
    const res = await AppApi.get<UserApiGetResponse>(
      `/api/v1/users/${id}`
    ).catch((e: AxiosError) => {
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

    return res.data;
  }

  /**
   * ユーザー追加
   * @param param
   */
  async save(param: UserApiSaveParam): Promise<void> {
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
  async update(param: UserApiUpdateParam): Promise<void> {
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
  async delete(id: string): Promise<void> {
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
