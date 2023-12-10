export class UserApiListParam {
  constructor(
    public page = 1,
    public pageSize = 10,
    public sort = "-username"
  ) {}
}
