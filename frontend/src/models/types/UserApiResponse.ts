import { ListMetaResponse } from "@/models/types/ListMetaResponse";
import { UserApiDataResponse } from "@/models/types/UserApiDataResponse";

export type UserApiResponse = {
  data: UserApiDataResponse[];
  meta: ListMetaResponse;
};
