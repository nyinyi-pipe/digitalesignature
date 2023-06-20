<template>
  <div class="min-h-screen w-full hero">
    <Navbar :user="auth.user" />
    <div class="text-center mt-10">
      <h1
        id="typewriter"
        class="text-2xl text-red-500 font-bold uppercase"
      ></h1>
      <div class="mt-5">
        <Link href="/" class="py-1 px-3 bg-teal-500 rounded-sm text-white"
          >Go to home</Link
        >
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
import Typewriter from "typewriter-effect/dist/core";
import { onMounted } from "vue";

onMounted(() => {
  new Typewriter("#typewriter", {
    strings: ["Waiting", "Approvement"],
    autoStart: true,
    loop: true,
    delay: 75,
  });
});
defineProps({
  auth: Object,
});
</script>
