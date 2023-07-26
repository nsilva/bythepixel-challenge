import { defineStore } from "pinia";
import { fetchUsers } from "@/services/api";

export const useUsers = defineStore("users", {
  state: () => ({
    usersList: null,
  }),
  actions: {
    async getUsers() {
      this.usersList = await fetchUsers();
      console.log(this.usersList)
    },
  },
  getters: {
    getUsersList: (state) => {
      state.usersList;
    },
  },
});
