export class User {
  constructor(
    public readonly id: string,
    public readonly username: string,
    public readonly password: string,
    public readonly roleName: string,
    public readonly name: string,
    public readonly created: Date,
    public readonly modified: Date
  ) {}
}
