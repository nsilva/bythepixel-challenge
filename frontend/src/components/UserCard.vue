<script setup lang="ts">
import { defineEmits } from 'vue';
import { TheCard } from "flowbite-vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(["userSelected"]);

const handleUserSelect = (user: Object) => {
  emit("userSelected", user);
};
</script>

<template>
  <the-card href="#">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ user.name }}</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400"><Icon class="inline align-sub" icon="fluent:temperature-16-filled" />{{ user.temp }}&deg; F</p>
    <a @click.prevent="handleUserSelect(user)"><small>More details</small></a>
  </the-card>
</template>
