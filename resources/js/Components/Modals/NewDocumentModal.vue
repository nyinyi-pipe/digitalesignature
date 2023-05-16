<template>
  <div
    id="newDocumentUploadModal"
    tabindex="-1"
    class="fixed top-0 hidden left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded shadow-lg border border-gray-200">
        <button
          @click="$emit('closeNewDocumentUpload')"
          type="button"
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
        <h1 class="text-green-500 px-6 mb-3 mt-5 font-bold">New Document</h1>
        <div class="p-4">
          <div class="flex items-center justify-center w-full">
            <label
              for="dropzone-file"
              class="flex flex-col items-center justify-center w-full h-96 border-2 border-green-300 border-dashed rounded-lg cursor-pointer bg-green-50 dark:hover:bg-bray-800 dark:bg-green-700 hover:bg-green-100 dark:border-green-600 dark:hover:border-green-500 dark:hover:bg-green-600"
            >
              <div
                id="upload-text"
                class="flex flex-col items-center justify-center pt-5 pb-6"
              >
                <svg
                  aria-hidden="true"
                  class="w-10 h-10 mb-3"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                  ></path>
                </svg>
                <p class="mb-2 text-sm">
                  <span class="font-semibold"
                    >Drag and drop your files here</span
                  >
                </p>
                <p class="text-xs">
                  Supported files: PDF, Word, PowerPoint, JPG, PNG
                </p>
                <p
                  class="py-1.5 hover:bg-slate-100 hover:shadow-md duration-300 px-2 bg-white rounded text-sm shadow-xl mt-3 flex items-center gap-1 justify-center"
                >
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
                      d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                    />
                  </svg>

                  Select files
                </p>
              </div>
              <input
                id="dropzone-file"
                @change="upload"
                type="file"
                class="hidden"
              />
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
const documents = defineProps({
  id: Number,
});
const emit = defineEmits("closeNewDocumentUpload");
const form = useForm({
  newDocument: null,
  _method: "PUT",
});
const upload = (e) => {
  const reader = new FileReader();
  reader.onload = (evt) => {
    form.newDocument = e.target.files[0];
  };

  reader.onloadstart = (evt) => {
    document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Uploading...</h1>
        <p>${e.target.files[0].name}</p>
        <p class="py-1.5 hover:bg-slate-100 hover:shadow-md duration-300 px-2 bg-white rounded text-sm shadow-xl mt-3 flex items-center gap-1 justify-center">Cancel</p>
    `;
  };

  reader.onprogress = () => {
    setTimeout(() => {
      document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Progress...</h1>
        <p>${e.target.files[0].name}</p>
    `;
    }, 2000);
  };

  reader.onloadend = (evt) => {
    setTimeout(() => {
      form.post(route("document.new.document-name", documents.id), {
        onSuccess: () => {
          location.reload();
        },
      });
      emit("closeNewDocumentUpload");
    }, 4000);
  };

  reader.readAsDataURL(e.target.files[0]);
};
</script>

