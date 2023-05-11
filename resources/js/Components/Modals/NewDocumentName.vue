<template>
  <div
    id="changeDocumentName"
    tabindex="-1"
    class="fixed top-0 left-0 right-0 z-[9000] hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-md max-h-full">
      <div class="relative bg-white rounded shadow-lg border border-gray-200">
        <button
          type="button"
          @click="$emit('closeMailModal')"
          class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
        >
          <svg
            aria-hidden="true"
            class="w-5 h-5"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <h1 class="text-green-500 px-6 mb-3 mt-5 font-bold">
          New Document Name
        </h1>
        <div class="px-6 mb-4">
          <input
            type="text"
            v-model="form.newDocumentName"
            class="w-full focus:ring-green-500 focus:border-green-500 p-0 text-sm px-2 py-1.5 border-gray-300 rounded"
          />
        </div>
        <div class="flex gap-4 px-6 pb-6 justify-end">
          <button
            type="button"
            @click="$emit('closeMailModal')"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded border border-gray-200 text-sm font-medium px-6 py-1.5 hover:text-gray-900 focus:z-10"
          >
            Cancel
          </button>
          <button
            type="button"
            @click="$emit('saveDocumentName')"
            class="text-white duration-200 bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-sm inline-flex items-center px-6 py-1.5 text-center mr-2"
          >
            Save
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  form: Object,
});
</script>
