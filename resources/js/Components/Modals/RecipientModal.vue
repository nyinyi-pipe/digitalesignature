<template>
  <div
    id="newRecipient"
    tabindex="-1"
    class="fixed top-0 left-0 hidden right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-lg max-h-full">
      <div class="relative bg-white rounded shadow-lg border border-gray-200">
        <button
          @click="$emit('closeNewRecipientModal')"
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
        <h1 class="px-4 mb-3 mt-5 font-bold">Add Recipient</h1>
        <div class="px-4 mb-4">
          <form id="add-recipient" @submit.prevent="addRecipient">
            <div class="grid mb-5 gap-4 md:grid-cols-2">
              <div class="col-span-2">
                <label
                  for="email"
                  class="block mb-2 text-xs font-thin text-gray-500"
                  >EMAIL <span class="text-red-500">*</span></label
                >
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                  required
                />
              </div>
              <div>
                <label
                  for="first_name"
                  class="block mb-2 text-xs font-thin text-gray-500"
                  >FIRST NAME</label
                >
                <input
                  type="text"
                  id="first_name"
                  v-model="form.firstName"
                  class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                  required
                />
              </div>
              <div>
                <label
                  for="last_name"
                  class="block mb-2 text-xs font-thin text-gray-500"
                  >LAST NAME</label
                >
                <input
                  type="text"
                  id="last_name"
                  v-model="form.lastName"
                  class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                  required
                />
              </div>
            </div>
          </form>
        </div>
        <div class="flex px-2 pb-3 justify-between">
          <button
            @click="$emit('closeNewRecipientModal')"
            type="button"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded border-gray-200 text-sm font-medium px-6 py-1.5 hover:text-gray-900 focus:z-10"
          >
            Cancel
          </button>
          <button
            form="add-recipient"
            type="submit"
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
import { useForm } from "@inertiajs/vue3";

const documents = defineProps({
  documents: Object,
});
const emit = defineEmits("closeNewRecipientModal");
const form = useForm({
  docId: documents.documents.id,
  email: "",
  firstName: "",
  lastName: "",
  _method: "PUT",
});
const addRecipient = () => {
  form.post(route("document.store-recipients", documents.documents.id), {
    onSuccess: () => {
      location.reload();
    },
  });
  emit("closeNewRecipientModal");
};
</script>
