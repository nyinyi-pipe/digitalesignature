<template >
  <Aside :auth="auth.user" :toggle="toggle" @closeToggle="closeToggle"></Aside>
  <div
    class="ml-auto h-screen lg:w-[82%] xl:w-[82%] 2xl:w-[85%] relative bg-gray-100"
  >
    <Navbar :auth="auth" :title="title" @toggleAside="toggleAside"></Navbar>

    <div class="sm:px-6 sm:pt-6 flex flex-col 2xl:container select-none">
      <slot />
      <Footer></Footer>
    </div>
  </div>
</template>
<script setup>
import Navbar from "@/Components/Layouts/Navbar.vue";
import Aside from "@/Components/Layouts/Aside.vue";
import Footer from "@/Components/Layouts/Footer.vue";
import { ref } from "vue";
defineProps({
  title: String,
  auth: Object,
});
const toggle = ref(false);
const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};
</script>
