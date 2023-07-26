import { defineStore } from "pinia";
import { fetchUsers, fetchUserWeather } from "@/services/api";

export const useUsers = defineStore("users", {
  state: () => ({
    usersList: null,
    selectedUser: null,
  }),
  actions: {
    async fetchUsers() {
      this.usersList = await fetchUsers();
      console.log(this.usersList)
    },
    async getUserWeather() {
      if (this.usersList) {
        const weather = await fetchUserWeather(id);
        console.log(weather);
        const user = this.usersList.find((user: any) => {
          return user.id === id;
        });

        if (user) {
          user.weather = weather;
        }
      }
    },
    setSelectedUser(user: any) {
      this.selectedUser = user;
    },
  },
  getters: {
    getUsersList: (state) => {
      state.usersList;
    },
    getSelectedUserWeather: (state) => {
      state?.selectedUser?.weather ?? null;
    },
  },
});
