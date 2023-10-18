export default class ApiErrorItem {
  field: string;
  reason: string;

  constructor(field: string, reason: string) {
    this.field = field;
    this.reason = reason;
  }
}
