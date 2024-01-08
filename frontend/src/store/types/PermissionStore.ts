export type PermissionStore = {
  [key: string]: string[];
};

export type PermissionSetStore = {
  functionKey: string;
  arrowActions: string[];
};
