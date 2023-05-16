<template>
  <div>
    <h3 class="text-xs text-gray-400 mb-3 my-5">FILLABLE FIELDS FOR</h3>
    <div>
      <div class="relative cursor-pointer">
        <div v-if="choosed">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-3.5 h-3.5 absolute left-0 bottom-2 ml-1 text-blue-500 bg-blue-500 rounded-full"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>

          <input
            type="text"
            v-model="form.chooseRecipient"
            @focus="focusSearch"
            class="p-1 text-sm font-bold pl-6 border-0 border-b w-full peer-focus:border-0 focus:ring-0"
          />
        </div>
        <div v-else>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5 absolute left-0 bottom-1.5 text-gray-400"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
            />
          </svg>

          <input
            type="text"
            @focus="focusSearch"
            placeholder="Start typing name or email"
            class="p-1 text-sm text-gray-400 pl-7 border-0 border-b w-full peer-focus:border-0 focus:ring-0"
          />
        </div>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-5 h-5 absolute right-0 bottom-1.5 text-gray-400"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
          />
        </svg>
      </div>

      <div
        :class="[recipientStatus ? 'block' : 'hidden']"
        class="shadow mt-1.5"
      >
        <div
          v-for="(recipient, index) of documents.documents.recipients"
          :key="index"
        >
          <div
            @click="chooseRecipients"
            class="px-3 recipient flex py-1 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
          >
            <img
              src="https://media.istockphoto.com/id/1393750072/vector/flat-white-icon-man-for-web-design-silhouette-flat-illustration-vector-illustration-stock.jpg?s=612x612&w=0&k=20&c=s9hO4SpyvrDIfELozPpiB_WtzQV9KhoMUP9R9gVohoU="
              class="w-7 h-7 rounded-full"
              alt=""
            />
            <div>
              <h5 class="m-0 text-sm font-bold recipientName">
                {{ recipient.name }}
              </h5>
              <h4 class="m-0 text-xs font-thin recipientEmail text-slate-500">
                {{ recipient.email }}
              </h4>
            </div>
          </div>
        </div>
        <div
          @click="$emit('openNewRecipientModal')"
          class="px-3 flex py-1 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-7 h-7 rounded-full text-center text-green-500 bg-green-100 p-1"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
            />
          </svg>

          <div>
            <h5 class="m-0 text-sm font-bold text-green-500">Add recipient</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
onMounted(() => {});
const documents = defineProps({
  documents: Object,
});
const emit = defineEmits({
  choosedRecipient: (data) => {
    return data;
  },
});
const recipientStatus = ref(false);
const choosed = ref(false);
const form = useForm({
  chooseRecipient: "",
  chooseRecipientMail: "",
});
const focusSearch = () => {
  recipientStatus.value = !recipientStatus.value;
};
const chooseRecipients = (e) => {
  form.chooseRecipient = e.target
    .closest(".recipient")
    .querySelector(".recipientName").innerText;
  form.chooseRecipientMail = e.target
    .closest(".recipient")
    .querySelector(".recipientEmail").innerText;
  recipientStatus.value = !recipientStatus.value;
  choosed.value = true;
  emit("choosedRecipient", {
    name: form.chooseRecipient,
    email: form.chooseRecipientMail,
  });
};
</script>
