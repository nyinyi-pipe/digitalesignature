<template>
  <AuthLayout title="Bulk Import">
    <Head title="Document" />
    <h1 class="text-xl mb-3">Select documents</h1>
    <div class="flex items-center justify-center w-full">
      <label
        for="dropzone-file"
        class="flex flex-col items-center justify-center w-full h-64 border-2 border-green-300 border-dashed rounded-lg cursor-pointer bg-green-50 dark:hover:bg-bray-800 dark:bg-green-700 hover:bg-green-100 dark:border-green-600 dark:hover:border-green-500 dark:hover:bg-green-600"
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
            <span class="font-semibold">Drag and drop your files here</span>
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
        <input id="dropzone-file" @change="upload" type="file" class="hidden" />
      </label>
    </div>
  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link, router, Head } from "@inertiajs/vue3";
import convertPdfToImg from "@/composables/convertPdfToImg";

const upload = async (event) => {
  const file = event.target.files[0];

  if (file.type == "application/pdf") {
    const images = await convertPdfToImg(file);
    const form = {
      document: images,
      type: "pdf",
      name: file.name,
    };
    router.post(route("document.add-document"), form);
  } else {
    const reader = new FileReader();
    reader.onloadstart = (evt) => {
      document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Uploading...</h1>
        <p>${file.name}</p>
        <p class="py-1.5 hover:bg-slate-100 hover:shadow-md duration-300 px-2 bg-white rounded text-sm shadow-xl mt-3 flex items-center gap-1 justify-center">Cancel</p>
    `;
    };

    reader.onprogress = () => {
      setTimeout(() => {
        document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Progress...</h1>
        <p>${file.name}</p>
    `;
      }, 2000);
    };

    reader.onloadend = (evt) => {
      setTimeout(() => {
        const form = {
          document: [evt.target.result],
          type: "png",
          name: file.name,
        };
        router.post(route("document.add-document"), form);
      }, 4000);
    };

    reader.readAsDataURL(file);
  }
};
</script>
