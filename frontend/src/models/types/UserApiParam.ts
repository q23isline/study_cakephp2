export class UserApiListParam {
  page = 1;
  pageSize = 10;
  sort = "-username";

  constructor(page: number, pageSize: number, sort: string) {
    this.page = page;
    this.pageSize = pageSize;
    this.sort = sort;
  }
}

export type UserApiSaveParam = {
  username: string;
  password: string;
  roleName: string;
  name: string;
};

export type UserApiUpdateParam = {
  id: string;
  username: string;
  password: string;
  roleName: string;
  name: string;
};
