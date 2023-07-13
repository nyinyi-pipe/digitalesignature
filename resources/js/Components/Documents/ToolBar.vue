<template>
  <div
    class="sm:w-[37%] md:w-[30%] lg:w-[24%] h-screen flex"
    style="z-index: 20"
  >
    <div
      class="border-r flex-col border-l w-[16%] py-3 h-full flex items-center gap-4"
    >
      <div class="" title="content">
        <svg
          @click="setPwd = false"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          title="Content"
          stroke-width="1.5"
          stroke="currentColor"
          :class="[
            setPwd
              ? 'bg-gray-300 hover:bg-gray-400 hover:shadow transition-colors'
              : 'bg-teal-500 hover:bg-teal-300 transition-colors ',
          ]"
          class="w-5 h-5 cursor-pointer text-white rounded-full"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 6v12m6-6H6"
          />
        </svg>
      </div>
      <div class="" title="password">
        <svg
          @click="setPwd = true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          :class="[
            setPwd
              ? 'bg-teal-500'
              : 'bg-gray-300 hover:bg-gray-400 hover:shadow transition-colors ',
          ]"
          class="w-5 h-5 p-0.5 cursor-pointer text-white rounded-full"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
          />
        </svg>
      </div>
    </div>
    <aside class="h-full w-full px-3 py-2">
      <div class="flex items-center justify-between mb-4">
        <h2 v-if="setPwd" class="text-md font-bold">Security</h2>
        <h2 v-else class="text-md font-bold">Content</h2>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-5 h-5"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>

      <template v-if="setPwd">
        <SetPwd :document="document" />
      </template>
      <template v-else>
        <slot name="tools" />
        <slot name="fillabes" />
        <slot name="connectinitail" />
      </template>
    </aside>
  </div>
</template>
<script setup>
import { ref } from "vue";
import SetPwd from "@/Components/Documents/SetPwd.vue";
const setPwd = ref(false);
defineProps(["document"]);
</script>
