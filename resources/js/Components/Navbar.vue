<template>
  <div class="sticky z-10 top-0 h-14 bg-white">
    <div
      class="p-3 flex items-center justify-between overflow-hidden space-x-4 2xl:container"
    >
      <div class="flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-7 w-7 sm:w-8 sm:h-8 text-teal-500"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"
          />
        </svg>

        <Link
          href="/"
          class="text-3xl uppercase font-semibold text-teal-500 lg:block"
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
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-teal-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-teal-400 text-white"
            >Dashboard</Link
          >
          <Link
            v-else
            href="/dashboard"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-teal-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-teal-400 text-white"
            >Dashboard</Link
          >
        </div>
        <div v-else class="flex space-x-4 items-center pl-3">
          <Link
            href="/login"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-teal-500 hover:text-white sm:text-md px-2 transition-colors sm:px-3 rounded-full border-2 text-teal-500 border-teal-400"
            >Sign In</Link
          >
          <Link
            href="/register"
            class="py-1 sm:py-0.5 font-bold text-sm hover:bg-teal-500 sm:text-md px-2 transition-colors sm:px-3 rounded-full bg-teal-400 text-white"
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
