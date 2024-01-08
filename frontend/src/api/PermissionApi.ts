import { AxiosError } from "axios";
import { AppApi } from "@/api/AppApi";

type PermissionApiGetResponse = {
  data: string[];
};

class PermissionApi {
  /**
   * 権限取得
   * @param functionKey
   */
  async get(functionKey: string): Promise<PermissionApiGetResponse> {
    const res = await AppApi.get<PermissionApiGetResponse>(
      `/api/v1/permissions/${functionKey}`
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
}

export default new PermissionApi();
