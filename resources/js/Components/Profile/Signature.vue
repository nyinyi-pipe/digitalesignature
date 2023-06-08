<template>
  <div class="p-5 bg-white mt-3 shadow">
    <h1 class="text-2xl text-green-600 font-bold">Signature</h1>
    <hr class="mt-2 mb-7" />
    <div class="border-dashed border-2 border-gray-400 w-full sm:w-1/3">
      <img
        class="w-full user-signature"
        :src="[
          auth.user.signature ??
            'https://blog.rootshell.be/wp-content/uploads/2013/02/signature_scan.gif',
        ]"
        alt=""
      />
    </div>
    <div class="flex gap-2">
      <button
        @click="openSignature"
        class="py-1 rounded text-sm text-gray-600 hover:shadow-lg duration-200 transition-all px-3 hover:bg-gray-100 mt-3 shadow"
      >
        Change Signature
      </button>
      <button
        @click="downSignature"
        class="py-1 rounded text-sm text-white bg-blue-500 hover:shadow-lg duration-200 transition-all px-3 hover:bg-blue-600 mt-3 shadow"
      >
        Download
      </button>
    </div>
  </div>

  <SignatureModal
    @closeSignatureModal="closeSignatureModal"
    @acceptSignature="acceptSignature"
  />
</template>

<script setup>
import SignatureModal from "@/Components/Modals/SignatureModal.vue";
import { onMounted, ref } from "vue";
import { Modal } from "flowbite";
import { useForm } from "@inertiajs/vue3";
import download from "downloadjs";

const { auth } = defineProps({
  auth: Object,
});
const signatureModal = ref(null);
const openSignature = () => {
  signatureModal.value.show();
};
const closeSignatureModal = () => {
  signatureModal.value.hide();
};
const acceptSignature = (data) => {
  signatureModal.value.hide();
  const form = useForm({
    signature: data,
  });
  form.put(route("signature.update"));
};
const downSignature = () => {
  const signature = document.querySelector(".user-signature");
  download(signature.src, `${auth.user.name}-signature.png`, "image/png");
};
onMounted(() => {
  const modalSignature = document.querySelector("#signature-modal");
  signatureModal.value = new Modal(modalSignature);
});
</script>
