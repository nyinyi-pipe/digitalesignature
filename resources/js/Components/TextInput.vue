<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
  />
</template>
