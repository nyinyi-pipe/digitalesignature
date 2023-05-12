<template>
  <div
    class="sm:w-[37%] md:w-[30%] lg:w-[24%] h-screen flex"
    style="z-index: 20"
  >
    <div class="border-r border-l w-[16%] py-3 h-full flex justify-center">
      <div class="">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          title="Content"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-5 h-5 bg-blue-500 cursor-pointer text-white rounded-full"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 6v12m6-6H6"
          />
        </svg>
      </div>
    </div>
    <aside class="h-full w-full px-3 py-2">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-md font-bold">Content</h2>
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
      <slot name="tools" />
      <slot name="fillabes" />
    </aside>
  </div>
</template>
<script setup>
</script>
