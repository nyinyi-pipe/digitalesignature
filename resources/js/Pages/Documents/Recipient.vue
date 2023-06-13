<template>
  <AuthLayout title="Add Recipients" :auth="auth">
    <Head title="Add Recipients" />
    <div class="px-28 py-2">
      <div class="mb-5">
        <h1 class="text-xl font-bold">Add Recipients</h1>
        <p class="text-sm">Who'll be receiving this document?</p>
      </div>
      <div>
        <label
          for="document_name"
          class="block mb-2 text-sm text-gray-900 dark:text-white font-bold"
          >Document name <span class="text-red-600">*</span></label
        >
        <input
          type="text"
          id="document_name"
          v-model="form.docName"
          @keyup="documentInput"
          :class="[
            document_validate
              ? 'border-red-600  focus:ring-red-500 focus:border-red-500'
              : 'border-green-600 focus:ring-green-500 focus:border-green-500',
          ]"
          class="bg-white border text-gray-900 text-sm rounded-sm block w-full py-1.5 px-2"
          placeholder="document name"
          required
        />
        <p
          :class="[document_validate ? 'block' : 'hidden']"
          class="text-sm text-red-600 font-bold mt-1"
        >
          Document name is required
        </p>
      </div>
      <div class="mt-5 mb-2">
        <h1 class="text-sm font-light">
          Sender: <span class="font-bold">{{ currentUser }}</span>
        </h1>
      </div>
      <div class="p-5 mb-5 bg-white rounded-sm recipientField">
        <form>
          <div class="flex gap-4 items-center">
            <div class="flex-grow">
              <label for="email" class="block mb-2 text-xs font-thin"
                >EMAIL <span class="text-red-500">*</span></label
              >
              <input
                type="email"
                id="email"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Search by name or email"
                required
              />
            </div>
            <div class="flex-grow">
              <label for="first_name" class="block mb-2 text-xs font-thin"
                >FIRST NAME</label
              >
              <input
                type="text"
                id="first_name"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                required
              />
            </div>
            <div class="flex-grow">
              <label for="last_name" class="block mb-2 text-xs font-thin"
                >LAST NAME</label
              >
              <input
                type="text"
                id="last_name"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                required
              />
            </div>
            <div class="mt-6">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 cursor-pointer hover:text-red-600 hover:shadow-lg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                />
              </svg>
            </div>
          </div>
          <!-- <div class="flex gap-3 items-center">
            <SwitchField />
            <h5 class="text-sm">Recipient verification</h5>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 text-gray-600 cursor-pointer"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
              />
            </svg>
          </div> -->
        </form>
      </div>

      <div
        v-for="field of fields"
        :key="field"
        class="p-5 mb-5 bg-white rounded-sm recipientField"
      >
        <form>
          <div class="flex gap-4 items-center">
            <div class="flex-grow">
              <label for="email" class="block mb-2 text-xs font-thin"
                >EMAIL <span class="text-red-500">*</span></label
              >
              <input
                type="email"
                id="email"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Search by name or email"
                required
              />
            </div>
            <div class="flex-grow">
              <label for="first_name" class="block mb-2 text-xs font-thin"
                >FIRST NAME</label
              >
              <input
                type="text"
                id="first_name"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                required
              />
            </div>
            <div class="flex-grow">
              <label for="last_name" class="block mb-2 text-xs font-thin"
                >LAST NAME</label
              >
              <input
                type="text"
                id="last_name"
                class="bg-gray-100 border-0 border-b focus:ring-0 border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-green-500 focus:border-green-500 block w-full py-1.5 px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                required
              />
            </div>
            <div class="mt-6">
              <svg
                @click="deleteField(field)"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 cursor-pointer hover:text-red-600 hover:shadow-lg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                />
              </svg>
            </div>
          </div>
        </form>
      </div>
      <div class="my-5 flex justify-between">
        <div class="" @click="addRecipientField">
          <p
            class="text-sm font-bold text-gray-700 flex gap-2 hover:bg-gray-200 py-1.5 px-2.5 rounded duration-200 cursor-pointer"
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
                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
              />
            </svg>
            Add recipient
          </p>
        </div>
        <div class="flex gap-2">
          <Link
            href=""
            class="py-1.5 px-2.5 bg-gray-300 hover:bg-gray-400 duration-200 rounded text-sm text-gray-700 font-bold"
            >Skip</Link
          >
          <p
            @click="addRecipients"
            class="py-1.5 px-2.5 bg-green-600 hover:bg-green-500 duration-200 rounded text-sm text-white font-bold"
          >
            Continue
          </p>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>
  <script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import SwitchField from "@/Components/SwitchField.vue";
import { onMounted, ref } from "vue";
import { Link, Head, usePage, router, useForm } from "@inertiajs/vue3";

const documents = defineProps({
  AddedDocument: Object,
  auth: Object,
});

const fields = ref([]);
const document_name = ref("");
const currentUser = ref("");
const document_validate = ref(false);
const documentInput = () => {
  if (!form.docName) {
    document_validate.value = !document_validate.value;
  } else {
    document_validate.value = false;
  }
};

let count = 0;
const addRecipientField = () => {
  fields.value.push(count++);
  console.log(fields.value);
};

const deleteField = (id) => {
  fields.value = fields.value.filter((field) => field != id);
};
const form = useForm({
  docId: documents.AddedDocument.id,
  docName: documents.AddedDocument.doc_name,
  email: [],
  firstName: [],
  lastName: [],
});
const addRecipients = () => {
  const emails = document.querySelectorAll("#email");
  const first_names = document.querySelectorAll("#first_name");
  const last_names = document.querySelectorAll("#last_name");
  emails.forEach((email) => {
    form.email.push(email.value);
  });
  first_names.forEach((first) => {
    form.firstName.push(first.value);
  });
  last_names.forEach((last) => {
    form.lastName.push(last.value);
  });
  form.put(route("document.store-recipients", documents.AddedDocument.id));
};

onMounted(() => {
  if (!form.docName) {
    document_validate.value = !document_validate.value;
  }
  currentUser.value = usePage().props.auth.user.name;
});
</script>
<style scoped>
.recipientField::before {
  content: "";
  height: 100%;
  width: 4.5px;
  background-color: rgb(164, 164, 164);
  display: block;
  position: absolute;
  left: 0;
  top: 0;
}
.recipientField {
  position: relative;
}
</style>
