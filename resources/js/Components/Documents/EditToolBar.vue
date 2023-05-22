<template>
  <div
    class="sm:w-[32%] md:w-[22%] lg:w-[18%] border-r h-screen flex"
    style="z-index: 20"
  >
    <aside class="h-full w-full pb-16">
      <div
        class="flex items-center justify-between border-b p-3 pb-2 pl-4 mb-3"
      >
        <h2 class="text-xs tracking-widest font-bold">DOCUMENTS</h2>
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
      <div class="p-3 pl-4 overflow-scroll h-full">
        <div
          class="flex gap-4"
          v-for="(document, index) of documents.documents"
          :key="index"
        >
          <h1 class="text-sm">{{ index + 1 }}</h1>
          <img :src="document" class="w-[75%] mb-6 shadow" alt="document" />
        </div>
      </div>
    </aside>
  </div>
</template>
  <script setup>
const documents = defineProps({
  documents: Array,
});

const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};
</script>
