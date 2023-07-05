<template>
  <AuthLayout title="Bulk Import" :auth="auth">
    <Head title="Document" />
    <h1 class="text-xl mb-3">
      Select documents
      <span class="text-xs text-gray-600">(Maximum file size : 50MB)</span>
    </h1>
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
import { onMounted, ref } from "vue";
import { useLoading } from "vue-loading-overlay";

const imageDataList = ref([]);
const pdfPages = ref(null);
const loading = useLoading({
  color: "#ffffff",
  loader: "dots",
  width: 64,
  height: 64,
  backgroundColor: "#000000",
  opacity: 0.5,
  zIndex: 999,
});
defineProps({
  auth: Object,
});
const PDFJS = ref(null);
const loader = ref(null);
const upload = async (event) => {
  loader.value = loading.show();
  const file = event.target.files[0];
  const reader = new FileReader();

  if (file.type == "application/pdf") {
    const { data } = await axios({
      method: "POST",
      url: route("document.save.file"),
      data: { file },
      headers: { "Content-Type": "multipart/form-data" },
    });
    if (data.msg) {
      let url = data.path;
      let loadingTask = PDFJS.value.getDocument(url);
      const pdf = await loadingTask.promise;
      let totalPages = pdf.numPages;
      pdfPages.value = totalPages;
      for (let pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
        const page = await pdf.getPage(pageNumber);
        const viewport = page.getViewport({ scale: 1.3 });
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        const renderTask = page.render({
          canvasContext: context,
          viewport: viewport,
        });
        await renderTask.promise;
        imageDataList.value.push(canvas.toDataURL());
      }
      if (pdfPages.value == imageDataList.value.length) {
        const form = {
          document: imageDataList.value,
          type: "pdf",
          name: file.name,
        };
        router.post(route("document.add-document"), form, {
          onFinish: () => {
            loader.value.hide();
          },
        });
      }
    }
  } else {
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
        router.post(route("document.add-document"), form, {
          onFinish: () => {
            loader.value.hide();
          },
        });
      }, 4000);
    };

    reader.readAsDataURL(file);
  }
};

onMounted(() => {
  PDFJS.value = window["pdfjs-dist/build/pdf"];

  PDFJS.value.GlobalWorkerOptions.workerSrc =
    "//mozilla.github.io/pdf.js/build/pdf.worker.js";
});
</script>
