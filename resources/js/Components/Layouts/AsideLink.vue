<template>
  <Link
    :href="route(go)"
    :class="{ active: url === route(go) }"
    class="flex items-center px-3 py-2 text-gray-400 transition-colors duration-300 transform rounded-sm hover:bg-gray-600 hover:text-gray-300"
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
import { ref } from "vue";
const { go, title } = defineProps({
  go: String,
  title: String,
});
const url = ref(location.href);
</script>
<style scoped>
.active {
  background: rgba(255, 255, 255, 0.163);
  color: white;
}
</style>
