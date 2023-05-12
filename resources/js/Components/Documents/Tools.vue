<template>
  <h3 class="text-xs text-gray-400 mb-3">BLOCKS</h3>
  <div class="flex flex-wrap gap-2 relative">
    <div
      draggable="true"
      id="text"
      @dragstart="$emit('increaseText')"
      class="drag-field w-[48%] overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 flex justify-between"
    >
      <div class="drag-style h-full bg-green-100"></div>
      <div class="field-container p-3 pb-5 pt-2 flex justify-between w-full">
        <h5 class="text-xs font-bold">Text</h5>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-5 h-5 text-gray-500"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
          />
        </svg>
      </div>
    </div>

    <div
      draggable="true"
      id="signature"
      @dragstart="$emit('increaseSignature')"
      class="drag-field overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 w-[48%] flex justify-between"
    >
      <div class="drag-style h-full bg-green-100"></div>
      <div class="field-container p-3 pb-5 pt-2 flex justify-between w-full">
        <h5 class="text-xs font-bold">Signature</h5>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-5 h-5 text-gray-500"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
          />
        </svg>
      </div>
    </div>
  </div>
</template>
<script setup>
</script>
