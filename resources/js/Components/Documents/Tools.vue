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

    <div
      draggable="true"
      id="date"
      @dragstart="$emit('increaseDate')"
      class="drag-field overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 w-[48%] flex justify-between"
    >
      <div class="drag-style h-full bg-green-100"></div>
      <div class="field-container p-3 pb-5 pt-2 flex justify-between w-full">
        <h5 class="text-xs font-bold">Date</h5>
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
            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"
          />
        </svg>
      </div>
    </div>

    <div
      draggable="true"
      id="initial"
      @dragstart="$emit('increaseInitial')"
      class="drag-field overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 w-[48%] flex justify-between"
    >
      <div class="drag-style h-full bg-green-100"></div>
      <div class="field-container p-3 pb-5 pt-2 flex justify-between w-full">
        <h5 class="text-xs font-bold">Initial</h5>
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
            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"
          />
        </svg>
      </div>
    </div>
  </div>
</template>
<script setup>
</script>
