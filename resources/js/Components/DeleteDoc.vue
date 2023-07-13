<template>
  <div class="menuDelete flex items-center flex-col relative">
    <svg
      @click="deleteDropDoc"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-6 h-6 deleteDocDrop rounded-full hover:bg-gray-300 duration-200 text-gray-500 cursor-pointer"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
      />
    </svg>
    <div
      :id="index"
      class="z-10 hidden absolute top-0 mt-7 deleteDoc bg-white rounded-sm shadow w-39"
    >
      <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
        <li
          :doc="doc"
          :index="index"
          @click="deleteDoc"
          class="px-2 py-1 select-none flex gap-2 text-gray-500 hover:text-red-500 duration-300 hover:bg-gray-100 items-center cursor-pointer"
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
              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
            />
          </svg>
          Delete
        </li>
      </ul>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

import { initFlowbite } from "flowbite";
import { onMounted, ref } from "vue";
const { index, documents, doc } = defineProps(["index", "documents", "doc"]);
onMounted(() => {
  initFlowbite();
});
const deleteDoc = (e) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      const doc = e.target.getAttribute("doc");
      const form = useForm({
        id: documents.documents.id,
        doc: doc,
        doc_id: e.target.getAttribute("index"),
        _method: "DELETE",
      });
      form.post(route("documents.delete.document", form.id), {
        onSuccess: () => {
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        },
      });
    }
  });
};
const deleteDropDoc = (e) => {
  const deleteMenu = e.target
    .closest(".menuDelete")
    .querySelector(".deleteDoc");
  if (deleteMenu.classList.contains("hidden")) {
    deleteMenu.classList.remove("hidden");
  } else {
    deleteMenu.classList.add("hidden");
  }
};
</script>
