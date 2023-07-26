<script setup lang="ts">
import { storeToRefs } from "pinia";
import { useUsers } from "@/stores/users";

const main = useUsers();
main.getUsers();

const { usersList } = storeToRefs(main);

</script>

<template>
    <div v-if="!usersList">
      Pinging the api..
    </div>
  
    <div v-if="usersList">
      <code>
      {{ usersList }}
      </code>
    </div>
  </template>