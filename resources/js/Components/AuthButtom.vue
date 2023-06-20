<template>
  <button
    :type="type"
    class="inline-flex w-full items-center px-4 py-2 bg-teal-500 rounded-sm text-white tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-600 focus:outline-none focus:ring-offset-2 transition ease-in-out duration-150 justify-center"
  >
    <slot />
  </button>
</template>
<script setup>
defineProps({
  type: {
    type: String,
    default: "submit",
  },
});
</script>
