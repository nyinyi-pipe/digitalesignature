<template>
  <div>
    <div
      ref="navbar"
      class="fixed bg-white z-50 transition-all duration-300 top-0 w-full -translate-y-[100%]"
    >
      <div class="container mx-auto relative">
        <nav
          class="h-24 bg-white w-full flex items-center relative z-50 justify-between"
        >
          <a href="/">
            <img src="/images/home/securesign.png" class="h-16" alt="" />
          </a>
          <div>
            <svg
              @click="openMenu"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-12 h-12 cursor-pointer"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
              />
            </svg>
          </div>
        </nav>
        <div
          ref="menu"
          class="bg-white absolute w-[40%] right-0 z-40 -translate-y-[100%] transition-all duration-300"
        >
          <ul class="flex flex-col">
            <li class="hover:bg-gray-50 hover:text-teal-500 py-3 px-10">
              <Link href="/" class="text-2xl">Home</Link>
            </li>
            <li class="hover:bg-gray-50 hover:text-teal-500 py-3 px-10">
              <Link :href="route('login')" class="text-2xl">Sign In</Link>
            </li>
            <li class="hover:bg-gray-50 hover:text-teal-500 py-3 px-10">
              <Link :href="route('register')" class="text-2xl">Sign Up</Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="hero h-screen w-full">
      <div class="h-10 nav-tap-bar"></div>
      <div class="flex justify-center pt-7 pb-16">
        <img src="/images/home/securesign.png" class="h-24" alt="securesign" />
      </div>
      <div class="grid grid-cols-2 gap-2 w-[95%] mx-auto">
        <div class="translate-x-28">
          <h1 class="text-6xl font-semibold tracking-tight hero-title">
            Everything you business <span class="text-[#4DD583]">needs</span> in
            one place
          </h1>
          <div class="flex items-center gap-8 mt-24">
            <Link
              :href="route('login')"
              class="py-1 md:py-4 px-2 md:px-24 text-2xl rounded-full bg-gray-200"
            >
              Sign In
            </Link>
            <Link
              :href="route('register')"
              class="py-1 md:py-4 px-2 md:px-24 text-2xl rounded-full bg-gray-200"
            >
              Sign Up
            </Link>
          </div>
        </div>
        <div class="translate-x--5">
          <img src="/images/home/Data.png" class="h-[77%]" alt="" />
        </div>
      </div>
    </div>
    <div class="my-32 mt-52 container mx-auto">
      <h1 class="text-[1.4rem] text-end mr-20">
        © 2023 SecureSign. by
        <span class="text-teal-500">GENI</span>
      </h1>
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
const menu = ref(null);
const navbar = ref(null);
onMounted(() => {
  window.addEventListener("scroll", () => {
    if (parseInt(window.scrollY) >= 50) {
      navbar.value.classList.remove("-translate-y-[100%]");
    } else {
      navbar.value.classList.add("-translate-y-[100%]");
    }
  });
});
const openMenu = () => {
  if (menu.value.classList.contains("-translate-y-[100%]")) {
    menu.value.classList.remove("hidden");
    menu.value.classList.remove("-translate-y-[100%]");
  } else {
    menu.value.classList.add("-translate-y-[100%]");
  }
};
</script>
<style scoped>
.hero {
  background-image: url("/public/images/home/firm2-slider-top-bg.png");
  background-repeat: no-repeat;
  background-size: cover;
}
@font-face {
  font-family: "Ubuntu";
  src: url("/public/fonts/Ubuntu/Ubuntu-Bold.ttf");
}
.hero-title {
  font-family: "Ubuntu";
  font-weight: 700;
}

.nav-tap-bar {
  background-color: rgba(114, 114, 114, 0.078);
}
</style>
