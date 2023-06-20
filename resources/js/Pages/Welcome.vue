<template>
  <div class="min-h-screen w-full hero">
    <Navbar :user="auth.user" />
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
defineProps({
  auth: Object,
});
</script>

  <style scoped>
.hero {
  background-image: url("/images/hero2.jpg");
  background-position: center;
  background-repeat: no-repeat;
  object-fit: cover;
  position: relative;
}
</style>
