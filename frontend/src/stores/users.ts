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
      console.log(this.usersList);
    },
    async getUserWeather() {
      if (this.selectedUser && !this.selectedUser.weather) {
        const weather = await fetchUserWeather(this.selectedUser.id);
        this.selectedUser.weather = weather;
        
        const user = this.usersList.find((user: any) => {
          return user.id === this.selectedUser.id;
        });

        if (user) {
          user.weather = weather;
        }
      }
    },
    setSelectedUser(user: any) {
      this.selectedUser = user;
    },
    resetSelectedUser(user: any) {
      this.selectedUser = null;
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
