<template>
  <div
    class="sm:w-[37%] md:w-[30%] lg:w-[24%] h-screen flex"
    style="z-index: 20"
  >
    <aside class="h-full w-full px-3 py-2 border-l">
      <div class="flex items-center justify-between mb-4"></div>
      <slot name="tools" />
      <slot name="fillabes" />
    </aside>
  </div>
</template>
  <script setup>
</script>
