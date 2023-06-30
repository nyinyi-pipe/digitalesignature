<template>
  <div class="min-h-screen container mx-auto flex flex-col py-8 sm:pt-0">
    <Navbar />
    <div class="mt-8 self-center">
      <div class="flex gap-2 items-center">
        <img
          src="/images/logo.png"
          class="bi bi-chat w-12 h-12 text-purple"
          alt=""
        />

        <h1 class="font-semibold text-2xl text-green-500">SecureSign</h1>
      </div>
      <h3 class="mt-2 text-center">
        <slot name="sub-label"> </slot>
      </h3>
    </div>
    <div
      class="w-full self-center sm:max-w-md mt-6 p-10 shadow-lg overflow-hidden rounded-md"
    >
      <slot />
    </div>
    <div class="mt-10">
      <slot name="loginOrRegister"></slot>
      <h2 class="text-center">
        &copy;2023 by <span class="font-bold">GENI.</span>
      </h2>
    </div>
  </div>
</template>
<script setup>
import Navbar from "@/Components/Navbar.vue";
defineProps({
  auth: Object,
});
</script>
