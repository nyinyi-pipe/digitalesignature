<template>
  <Head title="Document" />
  <EditAside :toggle="toggle" @closeToggle="closeToggle"></EditAside>
  <div class="h-screen overflow-hidden">
    <!-- signature modal -->
    <SignatureModal
      @acceptSignature="acceptSignature"
      @closeSignatureModal="closeSignatureModal"
    />

    <div
      class="sticky z-10 top-0 h-12 border-b bg-white flex items-center py-2 lg:py-2.5"
    >
      <div
        class="px-4 py-1 flex items-center w-full justify-between space-x-4 2xl:container"
      >
        <div class="flex gap-3 items-center justify-center">
          <div>
            <img
              src="https://s3.amazonaws.com/pd-static-content/logos/logo-pandadoc-ev2.png"
              class="h-7 w-28"
              alt=""
            />
          </div>
          <div>
            <h3 class="font-semibold text-sm">
              {{ documents.documents.doc_name }}
            </h3>
            <h5 class="text-xs font-thin text-gray-500">
              by {{ documents.auth.user.name }}
            </h5>
          </div>
        </div>

        <div class="flex items-center gap-3">
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
        </div>
      </div>
    </div>
    <div class="flex relative">
      <EditToolBar :documents="documents.documents.doc_docs" />

      <div
        class="sm:w-[68%] pb-16 h-screen md:w-[78%] lg:w-[82%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed bg-white px-5 flex user-select-none"
          style="z-index: 20"
        >
          <div class="flex py-1.5 gap-2 pr-3">
            <div class="flex items-center gap-1 px-1.5 rounded h-7">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-green-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                />
              </svg>
            </div>
            <div class="flex items-center gap-1 px-1.5 h-7">
              <span class="text-gray-500 font-thin text-sm"
                >Please fill in 1 required field.</span
              >
            </div>
          </div>
        </div>
        <div
          class="px-5 w-full mt-10 md:w-[80%] lg:w-[78%] mx-auto relative flex flex-col justify-center items-center"
          style="z-index: 10"
        >
          <div class="mt-4 -mb-7 w-full flex justify-between">
            <h1 class="font-bold">
              {{ documents.documents.doc_name }}
            </h1>
            <h4 class="text-gray-400">
              {{ documents.documents.doc_docs.length }} of 1 document
            </h4>
          </div>
          <div
            v-for="(doc, index) of documents.documents.doc_docs"
            :key="index"
          >
            <div class="relative mt-12" id="main">
              <img
                id="image"
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
                @click="openSignatureModal"
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border items-center fieldStatus justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
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
                @click="openSignatureModal"
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center field-container justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
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
    </div>
  </div>
</template>
  <script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted, reactive, ref } from "vue";
import { initFlowbite, Modal } from "flowbite";
import SignatureModal from "@/Components/Modals/SignatureModal.vue";
import EditAside from "@/Components/Layouts/EditAside.vue";
import EditToolBar from "@/Components/Documents/EditToolBar.vue";

const toggle = ref(false);
const signatureModal = ref(null);
const signatureResult = ref(false);
const documents = defineProps({
  documents: Object,
  auth: Object,
});

const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};

const closeSignatureModal = () => {
  signatureModal.value.hide();
};

const closeToggle = () => {
  toggle.value = !toggle.value;
};

const indexs = ref(null);
const openSignatureModal = (e) => {
  indexs.value = e.target.closest(".fields").getAttribute("index");
  let target = e.target.closest(".fields").querySelector(".field-container");
  if (target.classList.contains("hidden")) {
    target.classList.remove("hidden");
    e.target
      .closest(".fields")
      .querySelector(".fieldStatus")
      .classList.add("hidden");
  }
  //   signatureResult.value = true;
  signatureModal.value.show();
};

onMounted(() => {
  const modalSignature = document.querySelector("#signature-modal");
  signatureModal.value = new Modal(modalSignature);

  const mainTag = document.querySelectorAll("#main");

  const signatures = document.querySelectorAll(".signature");
  signatures.forEach((signature, index) => {
    signature.style.top = documents.documents.signatures[index].y;
    signature.style.left = documents.documents.signatures[index].x;
    signatureResult.value = documents.documents.signatures[index].result;
    mainTag[documents.documents.signatures[index].index].append(signature);
  });

  initFlowbite();
});

const acceptSignature = (data) => {
  //   signatureResult.value = data;
  signatureModal.value.hide();
  const signatures = document.querySelectorAll(".signature");
  signatures[indexs.value].querySelector(".img").src = data;
  const form = useForm({
    signature: data,
    doc_id: documents.documents.id,
    _method: "PUT",
  });

  form.post(
    route("recipient.update.document", [
      signatures[indexs.value].querySelector(".img").getAttribute("id"),
      signatures[indexs.value].querySelector(".img").getAttribute("user_id"),
    ]),
    {
      onSuccess: () => location.reload(),
    }
  );
};
</script>
  <style scoped>
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
