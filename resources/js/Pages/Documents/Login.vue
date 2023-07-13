<template>
  <div class="min-h-screen container mx-auto flex flex-col py-8 sm:pt-0">
    <Head title="Sign In" />
    <div class="mt-10 self-center">
      <div class="flex gap-2 items-center">
        <img
          src="/images/logo.png"
          class="bi bi-chat w-12 h-12 text-purple"
          alt=""
        />

        <h1 class="font-semibold text-2xl text-green-500">SecureSign</h1>
      </div>
      <h3 class="mt-2 text-center">Login to continue of document</h3>
    </div>
    <div
      class="w-full self-center sm:max-w-md mt-5 p-10 shadow-lg overflow-hidden rounded-md"
    >
      <form @submit.prevent="submit">
        <InputError :message="error" />

        <div>
          <InputLabel for="Password" value="Password" />

          <div class="relative mb-6">
            <div
              class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                class="bi bi-shield-lock w-5 h-5 text-slate-500"
                viewBox="0 0 16 16"
              >
                <path
                  d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"
                />
                <path
                  d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"
                />
              </svg>
            </div>
            <TextInput
              id="password"
              type="password"
              class="mt-2 block w-full"
              v-model="form.password"
              required
              placeholder="•••••••••"
            />
          </div>
        </div>

        <div class="mt-3">
          <AuthButtom class="w-full" :class="{ 'opacity-25': form.processing }">
            Fill Password
          </AuthButtom>
        </div>
      </form>
    </div>
    <div class="mt-10">
      <h2 class="text-center">
        &copy;2023 by <span class="font-bold">GENI.</span>
      </h2>
    </div>
  </div>
</template>
<script setup>
import TextInput from "@/Components/TextInput.vue";
import AuthButtom from "@/Components/AuthButtom.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
const form = useForm({
  password: "",
  //   remember: false,
});
const { document, recipient } = defineProps({
  document: Object,
  recipient: String,
});

const submit = () => {
  form.post(route("doc.password.login", [document.id, recipient]), {
    onError: ({ password }) => console.log(password),
  });
};
</script>
