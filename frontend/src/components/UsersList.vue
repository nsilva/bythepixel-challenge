<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useUsers } from "@/stores/users";
import UserCard from "@/components/UserCard.vue";
import WeatherModal from "@/components/modals/WeatherModal.vue";
import { Toast } from "flowbite-vue";

const main = useUsers();

onMounted(() => {
  main.fetchUsers();
});

const handleUserSelect = (user: any) => {
  main.setSelectedUser(user);
  if (!user.weather) {
    main.getUserWeather();
  }
};

const resetSelectedUser = (user: any) => {
  main.setSelectedUser(user);
};

const { usersList, selectedUser, serverError } = storeToRefs(main);
</script>

<template>
  <Toast type="warning" v-if="serverError" closable class="absolute top-10 right-10 border-solid border-1 drop-shadow-md">
    {{ serverError }}
  </Toast>
  <div v-if="!usersList">Fetching users...</div>
  <div v-if="usersList">
    <div class="columns-3">
      <div v-for="user in usersList" :key="user.id" class="w-full">
        <user-card :user="user" @userSelected="handleUserSelect"></user-card>
      </div>
    </div>
    <weather-modal v-if="selectedUser?.weather" :weather="selectedUser?.weather" @modalClosed="resetSelectedUser"></weather-modal>
  </div>
</template>
