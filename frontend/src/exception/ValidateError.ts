import { ErrorItem } from "@/exception/types/ErrorItem";

export default class ValidateError {
  message: string;
  errors: ErrorItem[];

  constructor(message: string, errors: ErrorItem[]) {
    this.message = message;
    this.errors = errors;
  }
}
