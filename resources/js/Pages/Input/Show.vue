<template>
  <Head title="Input"></Head>
  <AuthLayout :auth="auth" title="Input Documents">
    <div class="py-5 bg-white px-3">
      <h2 class="text-xl ml-12">
        {{ input.document.doc_name }}
      </h2>
      <div class="ml-12 flex space-x-2 mt-2">
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
            d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"
          />
        </svg>

        <button
          class="font-light text-gray-500 text-xs px-1 border rounded bg-gray-300"
        >
          Inbox x
        </button>
      </div>

      <div class="my-5 flex justify-between">
        <div class="flex gap-3">
          <img
            class="h-10 w-10 object-cover rounded-full"
            :src="[
              input.recipient.avatar
                ? `/storage/${input.recipient.avatar}`
                : 'https://i.pinimg.com/564x/ff/5f/78/ff5f78476f0edf5b1bf7840f84342ebd.jpg',
            ]"
            alt=""
          />
          <div class="self-start">
            <div class="flex items-center space-x-2">
              <h3 class="font-bold">{{ input.recipient.name }}</h3>
              <h5 class="font-light text-xs text-gray-500">
                >{{ input.recipient.email }}
              </h5>
            </div>
            <div class="flex items-center gap-1">
              <h3 class="text-xs text-gray-500">to me</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-3 h-3"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                />
              </svg>
            </div>
          </div>
        </div>
        <div class="mt-1 flex gap-3">
          <p class="text-gray-500 text-xs">
            {{ moment(input.created_at).format("D MMM YYYY, h:mm:ss a") }}
          </p>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-4 h-4 cursor-pointer"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
            />
          </svg>
        </div>
      </div>

      <div class="ml-12 p-20 py-8 bg-gray-200">
        <div class="flex gap-3 mb-7 items-center">
          <img class="w-10 h-10 object-cover" src="/images/logo.png" alt="" />
          <h1 class="font-bold text-lg text-green-500">{{ auth.user.app }}</h1>
        </div>
        <div class="p-7 bg-white">
          <div class="w-full flex gap-4 pb-2 border-0 border-b-2">
            <img
              class="w-10 h-10 object-cover"
              :src="[
                input.recipient.avatar
                  ? `/storage/${input.recipient.avatar}`
                  : 'https://i.pinimg.com/564x/ff/5f/78/ff5f78476f0edf5b1bf7840f84342ebd.jpg',
              ]"
              alt=""
            />
            <div class="flex w-full gap-2 overflow-hidden">
              <h1 class="text-sm font-bold flex-none">
                {{ input.recipient.name }}
              </h1>
              <h5 class="text-sm font-light flex-none">sent you</h5>
              <h1 class="text-sm font-bold flex-wrap">
                {{ input.document.doc_name }}
              </h1>
            </div>
          </div>
          <div class="py-3 border-0 border-b-2">
            <p class="text-xs font-light text-gray-600">
              {{ input.content }}
            </p>
          </div>
          <div class="mt-4 flex w-full gap-3">
            <Link
              :href="route('document.view.document', input.document.id)"
              class="py-5 w-full text-center uppercase bg-green-500 text-white text-sm"
            >
              Open The Document
            </Link>
            <button class="py52 w-full uppercase text-gray-500 border text-sm">
              Forward
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>
  <script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link, Head } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import moment from "moment";

const { input, auth } = defineProps({
  input: Object,
  auth: Object,
});
onMounted(() => {
  console.log(input);
  initFlowbite();
});
</script>
