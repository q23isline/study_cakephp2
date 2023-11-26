import { ErrorItem } from "@/exception/types/ErrorItem";

/**
 * @link https://future-architect.github.io/typescript-guide/exception.html#id4
 */
export default class ValidateError extends Error {
  message: string;
  errors: ErrorItem[];

  constructor(message: string, errors: ErrorItem[], e?: string) {
    // Pass remaining arguments (including vendor specific ones) to parent constructor
    super(e);
    this.name = new.target.name;
    // 下記の行はTypeScriptの出力ターゲットがES2015より古い場合(ES3, ES5)のみ必要
    Object.setPrototypeOf(this, new.target.prototype);

    // Custom debugging information
    this.message = message;
    this.errors = errors;
  }
}
