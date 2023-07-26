<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useUsers } from "@/stores/users";
import UserCard from "@/components/UserCard.vue";

const main = useUsers();

onMounted(() => {
  main.fetchUsers();
});

const handleUserSelect = (user: any) => {
  main.setSelectedUser(user);
};

const { usersList, selectedUser } = storeToRefs(main);
</script>

<template>
  <div v-if="!usersList">Fetching users...</div>
  <div v-if="selectedUser">{{selectedUser?.name}}</div>
  <div v-if="usersList">
    <div class="columns-3">
      <div v-for="user in usersList" :key="user.id" class="w-full">
        <user-card :user="user" @userSelected="handleUserSelect"></user-card>
      </div>
    </div>
  </div>
</template>
