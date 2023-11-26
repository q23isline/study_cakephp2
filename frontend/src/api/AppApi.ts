import axios from "axios";

export const AppApi = axios.create({
  responseType: "json",
  headers: {
    "Content-Type": "application/json",
  },
});
