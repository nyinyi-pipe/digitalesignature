<template>
  <div class="min-h-screen w-full container mx-auto">
    <Navbar :user="auth.user" />
    <div
      class="min-h-screen mt-7 sm:-mt-10 flex flex-col gap-5 sm:gap-0 sm:flex-row items-center"
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
    <div class="mb-10">
      <h1
        class="text-center text-3xl underline font-extrabold text-teal-500 mb-7"
      >
        About Us
      </h1>
      <div class="grid sm:grid-cols-2 px-5 gap-3 sm:gap-0 sm:px-0 items-center">
        <div class="flex justify-center">
          <img
            src="/images/3d-casual-life-signing-contract.png"
            class="h-full"
            alt=""
          />
        </div>
        <div class="py-5">
          <h1 class="mb-4 text-gray-600 text-xl font-bold uppercase">
            Lorem ipsum dolor sit elit. Amet
          </h1>
          <p class="tracking-wide text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
            rerum iusto alias illo tenetur ullam non voluptatem praesentium
            accusamus, voluptates doloremque sunt minima nesciunt cumque
            incidunt accusantium nostrum eius corporis beatae eaque vitae?
            Beatae omnis, harum ipsum tenetur illum ratione eum voluptas eos
            magni sint natus iusto excepturi voluptates, illo vero dignissimos
            consequatur
          </p>
        </div>
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
