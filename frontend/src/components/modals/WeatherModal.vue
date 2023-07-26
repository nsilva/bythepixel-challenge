<script setup lang="ts">
import { Modal } from "flowbite-vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
  weather: {
    type: Object,
    required: true,
  },
});

const location = (props.weather.city && props.weather.country)
  ? ` at ${props.weather.city}, ${props.weather.country}`
  : '';

const emit = defineEmits(["modalClosed"]);

const handleModalClose = () => {
  emit("modalClosed");
};
</script>

<template>
  <Modal size="xl" @close="handleModalClose">
    <template #header>
      <div class="text-lg block">{{ weather.main }}</div>
    </template>
    <template #body>
      <div class="flex items-center text-lg">
        <Icon class="inline align-sub" icon="fluent:temperature-16-filled" />
        {{ weather.temp }}&deg; F {{location}}
      </div>
      <small v-if="weather.description">{{ weather.description }}</small>
      <div v-if="weather.temp_max" class="mt-4">
        <Icon class="inline align-sub mr-1" icon="fa6-solid:temperature-arrow-up" />Max {{ weather.temp_max }}&deg; F
      </div>
      <div v-if="weather.temp_min">
        <Icon class="inline align-sub mr-1" icon="fa6-solid:temperature-arrow-down" />Max {{ weather.temp_min }}&deg; F
      </div>
      <div v-if="weather.feels_like">
        <Icon class="inline align-sub mr-1" icon="carbon:temperature-feels-like" />Feels like {{ weather.feels_like }}&deg; F
      </div>
      <div v-if="weather.clouds">
        <Icon class="inline align-sub mr-1" icon="akar-icons:cloud" />Clouds {{ weather.clouds }}%
      </div>
      <div v-if="weather.humidity">
        <Icon class="inline align-sub mr-1" icon="uil:raindrops-alt" />Humidity {{ weather.humidity }}%
      </div>
      <div v-if="weather.wind_speed">
        <Icon class="inline align-sub mr-1" icon="tabler:wind" />Wind {{ weather.wind_speed.toFixed(2) }}mph
      </div>
    </template>
  </Modal>
</template>
