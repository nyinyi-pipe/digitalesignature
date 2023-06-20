<template>
  <div class="min-h-screen w-full container mx-auto">
    <Navbar :user="auth.user" />
    <div
      class="min-h-screen mt-7 sm:-mt-10 flex flex-col sm:flex-row items-center"
    >
      <div class="w-full px-5 sm:px-0 sm:w-[40%]">
        <h1 class="uppercase font-extrabold text-4xl text-teal-500">
          Secure Sign
        </h1>
        <p class="text-gray-400 mt-7">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati
          quo consequuntur nostrum itaque hic nesciunt quisquam delectus
          deserunt ut,
        </p>
        <div class="mt-9">
          <button
            class="uppercase hover:opacity-80 get-started font-bold flex items-center py-1 rounded-full text-sm px-4 bg-teal-500"
          >
            get started
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5 ml-1 transition-transform"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
              />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-full sm:w-[60%]">
        <img
          src="/images/silky-signing-the-contract.png"
          class="w-full object-cover"
          alt=""
        />
      </div>
    </div>
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
.get-started:hover svg {
  transform: translateX(10px);
}
</style>
