import { defineStore } from "pinia";
import { fetchUsers, fetchUserWeather } from "@/services/api";

export const useUsers = defineStore("users", {
  state: () => ({
    usersList: null,
    selectedUser: null,
    serverError: null,
  }),
  actions: {
    async fetchUsers() {
      try {
        this.usersList = await fetchUsers();
      } catch (error) {
        this.serverError = error.message;
        console.log(this.serverError);
      }
    },
    async getUserWeather() {
      // reset error
      this.serverError = null;

      if (this.selectedUser && !this.selectedUser.weather) {
        try {
          const weather = await fetchUserWeather(this.selectedUser.id);
          
          if (weather.length == 0) {
            throw new Error(`No weather data for ${this.selectedUser.name}`);
          }
          
          this.selectedUser.weather = weather;
          
          const user = this.usersList.find((user: any) => {
            return user.id === this.selectedUser.id;
          });

          if (user) {
            user.weather = weather;
          }
        } catch (error) {
          this.serverError = error.message;
          console.log(this.serverError);
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
