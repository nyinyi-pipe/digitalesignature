<template>
  <Head title="Document" />
  <EditAside :toggle="toggle" @closeToggle="closeToggle"></EditAside>
  <div class="h-screen overflow-hidden">
    <div
      class="sticky z-10 top-0 h-14 border-b bg-white flex items-center py-2 lg:py-2.5"
    >
      <div
        class="px-6 flex items-center w-full justify-between space-x-4 2xl:container"
      >
        <div class="flex gap-3 items-center justify-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-slate-500 cursor-pointer"
            @click="toggleAside"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>

          <div>
            <h3 class="font-bold text-sm mb-1">
              {{ documents.documents.doc_name }}
            </h3>
            <div class="flex items-center gap-3">
              <div class="flex items-center mr-2">
                <p class="sent"></p>
                <p class="text-indigo-600 font-thin text-xs">Sent</p>
              </div>
              <ul class="list-disc flex gap-7 items-center">
                <li class="flex">
                  <h5 class="text-xs font-thin text-gray-500">
                    {{ date }}
                  </h5>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button
            id="invite"
            data-dropdown-toggle="invite-dropdown"
            class="focus:outline-none rounded text-sm border focus:border-0 peer-focus:ring-0 px-4 py-1.5 shadow-md hover:bg-gray-100 hover:shadow-0 duration-200 text-center inline-flex items-center"
            type="button"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 text-green-600 font-bold mr-1"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
              />
            </svg>

            <span class="text-green-600 font-bold">Invite</span>
          </button>
          <!-- Invite Dropdown menu -->
          <div
            id="invite-dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow-lg w-44 dark:bg-gray-700"
          >
            <ul
              class="text-sm text-gray-700 dark:text-gray-200"
              aria-labelledby="invite"
            >
              <li>
                <a
                  href="#"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >Share via link</a
                >
              </li>
            </ul>
          </div>
          <!-- data-modal-target="popup-modal"
              data-modal-toggle="popup-modal" -->
          <button
            @click="openEmailModal"
            class="focus:outline-none rounded bg-green-600 text-sm focus:border-0 peer-focus:ring-0 px-5 py-1.5 shadow-md hover:shadow-0 duration-200 text-center inline-flex items-center"
          >
            <span class="text-white font-bold">Send</span>
          </button>

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
              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
          </svg>

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
              d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
            />
          </svg>

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
              d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
            />
          </svg>
        </div>
      </div>
    </div>
    <div class="flex relative">
      <div
        class="sm:w-[63%] pb-16 h-screen md:w-[70%] lg:w-[76%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed bg-white px-5 flex user-select-none"
          style="z-index: 20"
        >
          <div class="flex py-1.5 gap-2 pr-3">
            <div class="flex items-center gap-1 px-1.5 rounded h-6 bg-gray-100">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-gray-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                />
              </svg>
              <span class="text-gray-500 text-thin">1</span>
            </div>
          </div>
        </div>
        <div
          class="px-5 w-full mt-10 md:w-[87%] lg:w-[86%] mx-auto relative flex flex-col justify-center items-center"
          style="z-index: 10"
        >
          <h1 class="mt-2 -mb-5 font-bold w-full">
            {{ documents.documents.doc_name }}
          </h1>
          <div
            v-for="(doc, index) of documents.documents.doc_docs"
            :key="index"
          >
            <div class="w-full mt-6">
              <div class="flex justify-between w-full items-center mb-2">
                <div>
                  <h1 class="text-gray-500 text-xs">{{ index + 1 }} page</h1>
                </div>
              </div>
            </div>
            <div class="relative" id="main">
              <img
                id="image"
                :index="index"
                :doc="doc"
                class="w-full object-cover"
                :src="docs(doc)"
                alt=""
              />
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.signatures"
            :key="index"
          >
            <div
              draggable="true"
              class="fields absolute signature select-none"
              :index="index"
            >
              <div
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g
                    fill="none"
                    fill-rule="evenodd"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    transform="translate(3 3)"
                  >
                    <path
                      d="m14 1c.8284271.82842712.8284271 2.17157288 0 3l-9.5 9.5-4 1 1-3.9436508 9.5038371-9.55252193c.7829896-.78700064 2.0312313-.82943964 2.864366-.12506788z"
                    />
                    <path d="m6.5 14.5h8" />
                    <path d="m12.5 3.5 1 1" />
                  </g>
                </svg>
                <span>Signature</span>
              </div>
              <div
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <!-- <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-8 w-8"
                /> -->
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="sign.id"
                  :user_id="sign.user_id"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <ViewToolBar />
    </div>
  </div>
</template>
  <script setup>
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { Link, router, Head, useForm } from "@inertiajs/vue3";
import { onMounted, reactive, ref } from "vue";
import { initFlowbite, Modal } from "flowbite";
import EditAside from "@/Components/Layouts/EditAside.vue";
import ViewToolBar from "@/Components/Documents/ViewToolBar.vue";
import moment from "moment";

const documents = defineProps({
  documents: Object,
  auth: Object,
});

const toggle = ref(false);
const uploadedDocument = ref("");
const date = ref("");
const signatureResult = ref(null);

const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};

const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};

moment(documents.documents.updated_at).format("ll");

onMounted(() => {
  window.Pusher = Pusher;
  window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
  });
  window.Echo.channel("document").listen("DocumentEvent", ({ document }) => {
    document && location.reload();
    console.log(document);
  });
  const mainTag = document.querySelectorAll("#main");

  const signatures = document.querySelectorAll(".signature");
  signatures.forEach((signature, index) => {
    signature.style.top = documents.documents.signatures[index].y;
    signature.style.left = documents.documents.signatures[index].x;
    signatureResult.value = documents.documents.signatures[index].result;
    mainTag[documents.documents.signatures[index].index].append(signature);
  });

  date.value = `Updated ${moment(documents.documents.updated_at).format("ll")}`;
  uploadedDocument.value =
    location.origin + "/storage/documents/" + documents.documents.doc_docs;

  initFlowbite();
});
</script>
  <style>
.sent {
  width: 10px;
  height: 10px;
  background-color: rgb(53, 53, 255);
  border-radius: 50%;
  margin-right: 5px;
}

.drag-field:hover {
  cursor: move;
}
.drag-field:hover svg {
  display: none;
}

.drag-field:hover .drag-style {
  width: 14%;
}
</style>
