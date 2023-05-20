<template>
  <div
    id="sendMailModal"
    tabindex="-1"
    aria-hidden="true"
    class="fixed top-0 hidden left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%)] max-h-full"
  >
    <div class="relative w-full max-w-4xl max-h-full">
      <!-- Modal content -->
      <div
        class="relative bg-white w-full rounded-sm border border-gray-200 shadow-lg dark:bg-gray-700"
      >
        <button
          type="button"
          @click="$emit('closeSendMailModal')"
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
        <form @submit.prevent="sendMailSubmit">
          <div class="px-5 py-4">
            <h3 class="mb-4 text-lg font-bold">Send document</h3>
            <div class="flex justify-between w-full">
              <div class="flex flex-col gap-3 w-full">
                <div class="flex gap-9 w-full items-center">
                  <h5 class="text-xs font-thin text-gray-500">FROM</h5>
                  <div>
                    <h4 class="text-xs font-bold">
                      {{ auth.user.name }}
                    </h4>
                    <h5 class="text-xs font-thin text-gray-500">
                      {{ auth.user.email }}
                    </h5>
                  </div>
                </div>
                <div
                  class="flex gap-9 w-full items-center"
                  v-if="recipientEmails[0]"
                >
                  <h5 class="text-xs font-thin text-gray-500">To</h5>
                  <div class="ml-4 flex gap-1">
                    <div
                      v-for="(recipientEmail, index) of recipientEmails"
                      :key="index"
                    >
                      <h4
                        class="text-xs m-0 font-thin text-gray-500 py-1 px-1.5 rounded-lg bg-gray-100"
                      >
                        {{ recipientEmail.toLowerCase() }}
                      </h4>
                    </div>
                  </div>
                </div>
                <div v-else class="flex gap-9 w-full mt-1.5 items-center">
                  <h5 class="text-xs font-thin text-gray-500">CC</h5>
                  <div class="w-full relative items-center flex gap-1">
                    <div v-for="email of form.ccMails" :key="email">
                      <p
                        class="m-0 ccMail flex items-center text-xs p-1 font-thin text-gray-500 bg-gray-100 rounded-lg"
                      >
                        {{ email }}
                        <svg
                          @click="deleCcMail"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="ml-1 cursor-pointer hover:text-red-500 w-4 h-4"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                          />
                        </svg>
                      </p>
                    </div>
                    <input
                      @keypress.enter="newCCMail"
                      type="text"
                      placeholder="Start typing CC email"
                      class="w-full py-1 border-0 focus:ring-0 text-xs font-thin text-gray-500"
                    />
                  </div>
                </div>

                <div v-if="useCc" class="flex gap-9 w-full mt-1.5 items-center">
                  <h5 class="text-xs font-thin text-gray-500">CC</h5>
                  <div class="w-full relative items-center flex gap-1">
                    <div v-for="email of form.ccMails" :key="email">
                      <p
                        class="m-0 ccMail flex items-center text-xs p-1 font-thin text-gray-500 bg-gray-100 rounded-lg"
                      >
                        {{ email }}
                        <svg
                          @click="deleCcMail"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="ml-1 cursor-pointer hover:text-red-500 w-4 h-4"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                          />
                        </svg>
                      </p>
                    </div>
                    <input
                      @keypress.enter="newCCMail"
                      type="text"
                      placeholder="Start typing CC email"
                      class="w-full py-1 border-0 focus:ring-0 text-xs font-thin text-gray-500"
                    />
                  </div>
                </div>
              </div>
              <div
                class="w-full self-end flex justify-end"
                v-if="recipientEmails[0]"
              >
                <button
                  @click.prevent="addCC"
                  class="py-1 flex items-center text-sm px-1.5 mr-2 hover:bg-gray-100 rounded duration-100"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v12m6-6H6"
                    />
                  </svg>

                  Add CC
                </button>
              </div>
            </div>
            <hr class="mt-5 mb-3" />
            <div>
              <input
                type="text"
                class="w-full font-bold p-1 border-0 focus:border-0 focus:ring-0"
                placeholder="Subject"
                v-model="form.subject"
              />

              <div class="mt-1">
                <div class="">
                  <textarea
                    rows="10"
                    class="w-full p-1 text-gray-600 border-0 text-sm focus:border-0 focus:ring-0"
                    placeholder="Optional message..."
                    v-model="form.message"
                  ></textarea>
                </div>
                <div class="flex items-center justify-between mt-2">
                  <div class="flex">
                    <button
                      type="button"
                      class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100"
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
                          d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                      <span class="sr-only">Attach file</span>
                    </button>
                    <button
                      type="button"
                      class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
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
                          d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                      <span class="sr-only">Set location</span>
                    </button>
                    <button
                      type="button"
                      class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
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
                          d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                      <span class="sr-only">Upload image</span>
                    </button>
                  </div>
                  <button
                    type="submit"
                    class="inline-flex cursor-pointer items-center py-2 px-3 text-xs font-medium text-center text-white bg-green-600 rounded-sm focus:ring-4 focus:ring-green-200 hover:bg-green-700"
                  >
                    Send document
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref, onMounted, watch, reactive } from "vue";
const docuements = defineProps({
  auth: Object,
  document: Object,
  recipientEmails: Array,
});
const useCc = ref(false);

const form = useForm({
  toMails: [],
  ccMails: [],
  subject: `${docuements.auth.user.name} sent you ${docuements.document.doc_name}`,
  message: "",
});

const newCCMail = (e) => {
  e.preventDefault();
  form.ccMails.push(e.target.value);
  e.target.value = "";
};
const sendMailSubmit = () => {
  const mainTag = document.querySelectorAll(".fields");
  mainTag.forEach((main) => {
    let signDatas = reactive({
      docId: docuements.document.id,
      index: main
        .closest("#main")
        .querySelector("#image")
        .getAttribute("index"),
      type: main.getAttribute("types"),
      y: main.style.top,
      x: main.style.left,
      email: main
        .querySelector("#recipientName")
        .getAttribute("recipientEmail"),
    });
    axios
      .post(route("documents.store.document.result", signDatas))
      .then((res) => console.log(res.data));
  });
  form.toMails.push(...docuements.recipientEmails);
  form.post(route("document.send.mail", docuements.document.id), {
    onSuccess: () => {
      router.get(route("document.view.document", docuements.document.id));
    },
  });
};

const addCC = () => {
  useCc.value = true;
};

const deleCcMail = (e) => {
  e.target.closest(".ccMail").remove();
  const datas = document.querySelectorAll(".ccMail");
  const res = [];
  datas.forEach((data) => [res.push(data.innerText)]);
  form.ccMails = res;
};
</script>
