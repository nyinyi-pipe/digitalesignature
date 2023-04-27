<template >
  <Aside :toggle="toggle" @closeToggle="closeToggle"></Aside>
  <div class="ml-auto mb-6 lg:w-[82%] xl:w-[82%] 2xl:w-[85%] relative">
    <Navbar :title="title" @toggleAside="toggleAside"></Navbar>

    <div class="px-6 pt-6 2xl:container select-none">
      <slot />
    </div>
    <Footer></Footer>
  </div>
</template>
<script setup>
import Navbar from "@/Components/Layouts/Navbar.vue";
import Aside from "@/Components/Layouts/Aside.vue";
import Footer from "@/Components/Layouts/Footer.vue";
import { ref } from "vue";
defineProps({
  title: String,
});
const toggle = ref(false);
const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};
</script>
