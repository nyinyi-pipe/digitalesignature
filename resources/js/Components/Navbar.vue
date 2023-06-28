<template>
  <div class="sticky z-10 top-0 h-14 bg-white">
    <div
      class="p-3 flex items-center justify-between overflow-hidden space-x-4 2xl:container"
    >
      <div class="flex items-center gap-2">
        <img src="/images/logo.png" class="w-14 h-14" alt="" />

        <Link
          href="/"
          class="text-3xl uppercase font-semibold text-green-500 lg:block"
        >
          Secure Sign
        </Link>
      </div>

      <div class="sm:hidden">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-7 h-7"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
          />
        </svg>
      </div>
      <div class="hidden sm:flex space-x-4 items-center">
        <Link
          href="/"
          class="py-1 sm:py-0.5 text-sm sm:text-md px-2 transition-colors sm:px-3 rounded-full text-gray-400 font-bold"
          >HOME</Link
        >
        <Link
          href="/"
          class="py-1 sm:py-0.5 text-sm sm:text-md px-2 transition-colors sm:px-3 rounded-full text-gray-400 font-bold"
          >ABOUT</Link
        >
        <Link
          href="/"
          class="py-1 sm:py-0.5 text-sm sm:text-md px-2 transition-colors sm:px-3 rounded-full text-gray-400 font-bold"
          >SERVICE</Link
        >
        <Link
          href="/"
          class="py-1 sm:py-0.5 text-sm sm:text-md px-2 transition-colors sm:px-3 rounded-full text-gray-400 font-bold"
          >CONTACT</Link
        >

        <div v-if="user">
          <Link
            v-if="user.roles[0]?.name == 'admin'"
            href="/admin/dashboard"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-green-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-green-400 text-white"
            >Dashboard</Link
          >
          <Link
            v-else
            href="/dashboard"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-green-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-green-400 text-white"
            >Dashboard</Link
          >
        </div>
        <div v-else class="flex space-x-4 items-center pl-3">
          <Link
            href="/login"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-green-500 hover:text-white sm:text-md px-2 transition-colors sm:px-3 rounded-full border-2 text-green-500 border-green-400"
            >Sign In</Link
          >
          <Link
            href="/register"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-green-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-green-400 text-white"
            >Sign Up</Link
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  user: Object,
});
</script>
