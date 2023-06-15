<template>
  <div class="w-full flex justify-center items-center p-4 pt-7 pb-0">
    <img :src="auth.user.signature" width="400" alt="" />
  </div>
</template>
  <script setup>
import { onMounted, onUpdated } from "vue";
import { ref } from "vue";
const { auth } = defineProps({
  auth: Object,
});
const emit = defineEmits(["mysignature"]);
onMounted(() => {
  emit("mysignature", auth.user.signature);
});
onUpdated(() => {
  emit("mysignature", auth.user.signature);
});
</script>
