export default class User {
  id: string;
  username: string;
  password: string;
  roleName: string;
  name: string;
  created: Date;
  modified: Date;

  constructor(
    id: string,
    username: string,
    password: string,
    roleName: string,
    name: string,
    created: Date,
    modified: Date
  ) {
    this.id = id;
    this.username = username;
    this.password = password;
    this.roleName = roleName;
    this.name = name;
    this.created = created;
    this.modified = modified;
  }
}
