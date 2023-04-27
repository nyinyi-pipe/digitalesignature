<template>
  <Link
    :href="route(go)"
    class="flex w-full justify-between text-gray-400 hover:bg-gray-500 hover:text-green-500 focus:bg-gray-200 focus:text-green-500 cursor-pointer items-center p-2 rounded duration-200"
  >
    <p
      class="flex items-center outline-none focus:outline-none focus:ring-2 focus:ring-white"
    >
      <slot />
      <span class="text-sm ml-2 outline-none focus:outline-none">{{
        title
      }}</span>
    </p>
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  go: String,
  title: String,
});
</script>
