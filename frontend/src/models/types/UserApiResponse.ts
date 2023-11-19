import { ListMetaResponse } from "@/models/types/ListMetaResponse";
import { UserApiDataResponse } from "@/models/types/UserApiDataResponse";

export type UserApiListResponse = {
  data: UserApiDataResponse[];
  meta: ListMetaResponse;
};

export type UserApiGetResponse = {
  data: UserApiDataResponse;
};
