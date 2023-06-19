<template>
  <AuthLayout title="Documents" :auth="auth">
    <div class="p-3 shadow-md py-5 rounded">
      <div class="px-4">
        <div class="relative flex">
          <div
            class="py-1.5 font-bold cursor-pointer flex items-center gap-2 text-sm lg:text-md px-3 bg-green-500 text-white rounded-md mb-5"
            data-dropdown-toggle="add-dropdown"
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
                d="M12 4.5v15m7.5-7.5h-15"
              />
            </svg>

            New
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
                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
              />
            </svg>
          </div>

          <div
            id="add-dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
          >
            <ul class="text-sm text-gray-700 dark:text-gray-200">
              <li class="block py-2 hover:bg-green-100 cursor-pointer">
                <div class="gap-2 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"
                    />
                  </svg>

                  <Link
                    :href="route('document.add-document')"
                    class="text-green-500"
                    >Document</Link
                  >
                </div>
              </li>
              <li class="block py-2 hover:bg-green-100 cursor-pointer">
                <div class="gap-2 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"
                    />
                  </svg>

                  <Link
                    :href="route('document.add-document')"
                    class="text-green-500"
                    >Upload PDF</Link
                  >
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <Table :links="documents.documents.links">
        <template #th>
          <ThCol>
            <div class="flex items-center gap-x-3">
              <input
                type="checkbox"
                class="text-green-500 focus:ring-green-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"
              />
              <button class="flex items-center gap-x-2">
                <span>No</span>

                <svg
                  class="h-3"
                  viewBox="0 0 10 11"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.1"
                  />
                  <path
                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.1"
                  />
                  <path
                    d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.3"
                  />
                </svg>
              </button>
            </div>
          </ThCol>
          <ThCol>Document Name</ThCol>
          <ThCol> Status </ThCol>
          <ThCol> Date </ThCol>
          <ThCol> Action </ThCol>
        </template>
        <template #td>
          <tr
            v-for="(document, index) of documents.documents.data"
            :key="document.id"
          >
            <TdCol
              class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap"
            >
              <div class="inline-flex items-center gap-x-3">
                <input
                  type="checkbox"
                  class="text-green-400 border-gray-300 rounded focus:ring-green-400 duration-300"
                />

                <span>#000{{ index + 1 }}</span>
              </div>
            </TdCol>
            <TdCol>
              <Link
                href="/"
                class="inline-flex items-center px-3 py-0.5 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800"
              >
                <h2 class="text-xs font-normal">{{ document.doc_name }}</h2>
              </Link>
            </TdCol>

            <TdCol>
              <TdCol>
                <div
                  class="inline-flex items-center px-3 py-0.5 rounded-full gap-x-2"
                  :class="
                    document.doc_status == 3
                      ? 'text-green-500 bg-green-100/60'
                      : 'text-blue-500 bg-blue-100/60'
                  "
                >
                  <h2 class="text-xs font-normal">
                    {{ document.doc_status == 3 ? "Completed" : "Sent" }}
                  </h2>
                </div>
              </TdCol>
            </TdCol>
            <TdCol>
              {{ moment(document.created_at).format(" D MMM YYYY, h:mm:ss A") }}
            </TdCol>
            <TdCol>
              <div class="relative">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5 cursor-pointer editIter"
                  :data-id="document.id"
                  :status="document.doc_status"
                  :data-dropdown-toggle="documentdrop + document.id"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                  />
                </svg>

                <div
                  :id="documentdrop + document.id"
                  class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-20"
                >
                  <ul class="text-sm text-gray-700">
                    <Link
                      v-if="editStatus == 0"
                      :href="route('document.edit.document', editId)"
                      class="block py-1 hover:bg-yellow-100 cursor-pointer"
                    >
                      <div class="gap-2 flex items-center ms-2">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="w-4 h-4 text-yellow-500"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                          />
                        </svg>

                        <p class="text-yellow-500">Edit</p>
                      </div>
                    </Link>
                    <li
                      id="deledoc"
                      :data-id="document.id"
                      class="block py-1 hover:bg-red-100 cursor-pointer"
                      @click="deleDoc(document.id)"
                    >
                      <div class="gap-2 flex items-center justify-center">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="w-4 h-4 text-red-500"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                          />
                        </svg>

                        <p class="text-red-500">Delete</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </TdCol>
            <div
              id="deleteModal"
              tabindex="-1"
              aria-hidden="true"
              class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
            >
              <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div
                  class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
                >
                  <button
                    @click="cancelDeleDoc"
                    type="button"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                  <svg
                    class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                  <p class="mb-4 text-gray-500 dark:text-gray-300">
                    Are you sure you want to delete this document?
                  </p>
                  <div class="flex justify-center items-center space-x-4">
                    <button
                      @click="cancelDeleDoc"
                      type="button"
                      class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    >
                      No, cancel
                    </button>
                    <button
                      type="submit"
                      @click="acceptDelete(document.id)"
                      class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900"
                    >
                      Yes, I'm sure
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </tr>
        </template>
      </Table>
    </div>
  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Table from "@/Components/Table/Table.vue";
import ThCol from "@/Components/Table/ThCol.vue";
import TdCol from "@/Components/Table/TdCol.vue";
import { Link, Head, router } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { initFlowbite } from "flowbite";
import moment from "moment";
import { Modal } from "flowbite";

const deleteModal = ref(null);
const editStatus = ref(null);
const editId = ref(null);
const documents = defineProps({
  documents: Array,
  auth: Object,
});

const deleDoc = () => {
  deleteModal.value.show();
};

const cancelDeleDoc = () => {
  deleteModal.value.hide();
};
const deId = ref(null);
const acceptDelete = (id) => {
  router.delete(route("documents.delete-document", deId.value), {
    onSuccess: () => {
      location.reload();
    },
  });
};

onMounted(() => {
  const modal = document.querySelector("#deleteModal");
  deleteModal.value = new Modal(modal);
  initFlowbite();

  const editIters = document.querySelectorAll(".editIter");
  editIters.forEach((edit) => {
    edit.addEventListener("click", () => {
      editStatus.value = edit.getAttribute("status");
      editId.value = parseFloat(edit.getAttribute("data-id"));
      deId.value = parseFloat(edit.getAttribute("data-id"));
    });
  });
});
</script>
