<template>
  <div class="p-5 bg-white mt-3 shadow">
    <h1 class="text-2xl text-green-600 font-bold">Information</h1>
    <hr class="mt-2 mb-7" />

    <form @submit.prevent="changeInformation">
      <div class="grid gap-6 md:grid-cols-2">
        <div>
          <InputLabel for="firstName" value="First Name" />

          <div class="relative mb-6">
            <div
              class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-slate-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                />
              </svg>
            </div>
            <TextInput
              id="firstName"
              type="text"
              class="mt-2 block w-full"
              v-model="form.firstName"
              required
              placeholder="first name"
            />
          </div>
        </div>
        <div>
          <InputLabel for="lastName" value="Last Name" />

          <div class="relative mb-6">
            <div
              class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-slate-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                />
              </svg>
            </div>
            <TextInput
              id="lastName"
              type="text"
              class="mt-2 block w-full"
              v-model="form.lastName"
              required
              placeholder="first name"
            />
          </div>
        </div>
      </div>
      <div class="mb-6">
        <InputLabel for="Email" value="Email" />

        <div class="relative mb-6">
          <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
          >
            <svg
              aria-hidden="true"
              class="w-5 h-5 text-slate-500"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
              ></path>
              <path
                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
              ></path>
            </svg>
          </div>
          <TextInput
            id="email"
            type="email"
            class="mt-2 block w-full"
            v-model="form.email"
            required
            placeholder="example@gmail.com"
          />
        </div>
      </div>

      <div class="flex gap-2 justify-end">
        <button
          type="submit"
          class="text-white duration-300 bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-1 text-center dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-600"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { onMounted } from "vue";
const { auth } = defineProps({
  auth: Object,
});
const form = useForm({
  firstName: auth.user.first_name,
  lastName: auth.user.last_name,
  email: auth.user.email,
});

const changeInformation = () => {
  form.put(route("information.update"));
};
</script>
