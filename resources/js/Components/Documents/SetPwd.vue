<template>
  <div>
    <h3 class="text-xs text-gray-400 mb-3">SET PASSWORD</h3>
    <div class="">
      <div>
        <form @submit.prevent="setPwd">
          <input
            type="password"
            v-model="form.doc_key"
            placeholder="set document password"
            class="w-full text-sm pb-1 p-0 border-0 border-gray-400 text-gray-500 border-b focus:ring-0"
          />
          <button
            :type="[document.doc_key ? 'button' : 'submit']"
            :class="[
              document.doc_key
                ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
                : 'bg-teal-500 text-white  hover:bg-teal-600 transition-colors hover:shadow ',
            ]"
            class="text-xs w-full lg:text-sm mt-2 md:mt-3 py-1 px-2.5 rounded-sm"
          >
            {{ document.doc_key ? "Seted Password" : "Set Password" }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Swal from "sweetalert2";

const { document } = defineProps({
  document: Object,
});
const form = useForm({
  doc_key: document.doc_key,
  _method: "PUT",
});
const error = ref("");
const setPwd = () => {
  form.post(route("document.setPwd", document.id), {
    onError: ({ doc_key }) => (error.value = doc_key),
    onSuccess: () => {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      Toast.fire({
        icon: "success",
        title: "Set Password Successfully.",
      });
    },
  });
};
</script>
