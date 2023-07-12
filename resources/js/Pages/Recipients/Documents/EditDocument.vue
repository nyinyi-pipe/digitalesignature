<template>
  <Head title="Document" />
  <!-- <EditAside :toggle="toggle" @closeToggle="closeToggle"></EditAside> -->
  <div class="h-screen overflow-hidden">
    <!-- signature modal -->
    <SignatureModal
      @acceptSignature="acceptSignature"
      @closeSignatureModal="closeSignatureModal"
    />
    <InitialModal
      @acceptInitial="acceptInitial"
      @closeInitialModal="closeInitialModal"
    />

    <div
      class="sticky z-10 top-0 h-12 border-b bg-white flex items-center py-2 lg:py-2.5"
    >
      <div
        class="px-4 py-1 flex items-center w-full justify-between space-x-4 2xl:container"
      >
        <div class="flex gap-3 items-center justify-center">
          <div>
            <h1 class="text-2xl font-bold text-green-500">SecureSign</h1>
          </div>
          <div>
            <h3 class="font-semibold text-sm">
              {{ documents.documents.doc_name }}
            </h3>
            <h5 class="text-xs font-thin text-gray-500">
              by {{ documents.documents.user.name }}
            </h5>
          </div>
        </div>

        <!-- <div class="flex items-center gap-3">
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
        </div> -->
      </div>
    </div>
    <div class="flex relative">
      <EditToolBar
        :folder="documents.documents.folder"
        :documents="documents.documents.doc_docs"
      />

      <div
        class="sm:w-[68%] pb-16 h-screen md:w-[78%] lg:w-[82%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed bg-white px-5 flex user-select-none"
          style="z-index: 20"
        >
          <div
            class="flex items-center w-[80%] justify-between py-1.5 gap-2 pr-3"
          >
            <div class="flex gap-2">
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
              <!-- <div class="flex items-center gap-1 px-1.5 h-7">
                <span class="text-gray-500 font-thin text-sm"
                  >Please fill in 1 required field.</span
                >
              </div> -->
            </div>
            <div>
              <button
                @click="finished"
                class="m-0 py-0.5 px-4 rounded-sm bg-yellow-500"
              >
                Finish
              </button>
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
                :src="showDoc(doc)"
                alt=""
              />
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.signatures"
            :key="index"
          >
            <div class="fields absolute signature select-none" :index="index">
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
                v-if="documents.documents.status"
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center field-container justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="documents.documents.id"
                  :user_id="sign.nonuser_id"
                  :signId="sign.id"
                />
              </div>
              <div
                v-else
                @click="openSignatureModal"
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center field-container justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="documents.documents.id"
                  :user_id="sign.nonuser_id"
                  :signId="sign.id"
                />
              </div>
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.initials"
            :key="index"
          >
            <div class="fields absolute initial select-none" :index="index">
              <div
                @click="openInitialModal"
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
                <span>Initial</span>
              </div>
              <div
                v-if="documents.documents.status"
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center field-container justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="documents.documents.id"
                  :user_id="sign.nonuser_id"
                  :signId="sign.id"
                />
              </div>
              <div
                v-else
                @click="openInitialModal"
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border items-center field-container justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="documents.documents.id"
                  :user_id="sign.nonuser_id"
                  :signId="sign.id"
                />
              </div>
            </div>
          </div>

          <div v-for="(text, index) of documents.documents.texts" :key="index">
            <div class="absolute fields w-[140px] text select-none">
              <div v-if="!text.result">
                <div
                  @click="changeWriteStatus"
                  class="border signText flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-yellow-600 bg-transparent border-yellow-600"
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
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                  </svg>
                  <span>Text</span>
                </div>
                <div class="textInput hidden">
                  <input
                    type="text"
                    @keyup.enter="saveText"
                    v-model="form.signature"
                    :user_id="text.nonuser_id"
                    :id="text.id"
                    placeholder="something..."
                    class="p-0 py-1.5 px-2 w-full focus:ring-yellow-600 border-yellow-600 hover:border-yellow-600 focus:border-yellow-600 focus:outline-none"
                  />
                </div>
              </div>
              <div
                v-else
                @click="
                  () => {
                    if (!documents.documents.status) {
                      openText = !openText;
                    }
                  }
                "
                :class="[openText ? 'hidden' : 'flex']"
                class="border-yellow-500 p-1 overflow-hidden cursor-pointer border flex justify-center items-center"
              >
                <h1 class="w-full m-0 text-yellow-500 break-words">
                  {{ text.result }}
                </h1>
              </div>
              <div
                v-if="!documents.documents.status"
                :class="[openText ? 'flex' : 'hidden']"
              >
                <input
                  type="text"
                  @focusout="saveText"
                  v-model="form.signature"
                  :user_id="text.nonuser_id"
                  :id="text.id"
                  placeholder="something..."
                  class="p-0 py-1.5 px-2 w-full focus:ring-yellow-600 border-yellow-600 hover:border-yellow-600 focus:border-yellow-600 focus:outline-none"
                />
              </div>
            </div>
          </div>

          <div v-for="(date, index) of documents.documents.dates" :key="index">
            <div class="absolute fields date select-none">
              <div>
                <div v-if="!date.result" class="">
                  <input
                    @change="saveDate"
                    v-model="form.signature"
                    :user_id="date.nonuser_id"
                    :disabled="finish"
                    type="date"
                    :id="date.id"
                    class="border-pink-600 text-sm text-pink-600 bg-transparent"
                  />
                </div>
                <div
                  v-else
                  class="border-pink-500 p-1.5 border flex justify-center items-center"
                >
                  <h1 class="m-0 text-pink-500">{{ date.result }}</h1>
                </div>
              </div>
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.vsignatures"
            :key="index"
          >
            <div
              draggable="true"
              class="fields absolute vsignature select-none vuserSign"
              :index="index"
            >
              <div
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border-0 text-gray-400 signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm bg-gray-200"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5 text-gray-400"
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
                class="border-0 text-gray-400 imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm bg-gray-200"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img text-gray-400"
                  :id="sign.id"
                  :user_id="sign.user_id"
                />
              </div>
              <div
                class="w-full vuser relative z-50 hidden items-center mt-3 justify-center"
              >
                <h1
                  class="text-gray-400 m-0 w-auto bg-white px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ sign.name }}
                </h1>
              </div>
            </div>
          </div>

          <div
            v-for="(initial, index) of documents.documents.vinitials"
            :key="index"
          >
            <div
              draggable="true"
              class="fields absolute vinitial select-none vuserSign"
              :index="index"
            >
              <div
                :class="[initial.result ? 'hidden' : 'flex']"
                class="border-0 text-gray-400 signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm bg-gray-200"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5 text-gray-400"
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
                <span>Initial</span>
              </div>
              <div
                :class="[initial.result ? 'flex' : 'hidden']"
                class="border-0 text-gray-400 imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm bg-gray-200"
              >
                <img
                  :src="[initial.result ?? initialResult]"
                  alt=""
                  class="h-14 w-24 img text-gray-400"
                  :id="initial.id"
                  :user_id="initial.user_id"
                />
              </div>
              <div class="w-full vuser hidden items-center mt-3 justify-center">
                <h1
                  class="text-gray-400 bg-white m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ initial.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(text, index) of documents.documents.vtexts" :key="index">
            <div class="absolute fields w-[140px] vtext select-none vuserSign">
              <div
                @click="changeWriteStatus"
                :class="[text.result ? 'hidden' : 'flex']"
                class="border-0 text-gray-400 signText items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm bg-gray-200"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5 text-gray-400"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
                <span>Text</span>
              </div>
              <div
                :class="[text.result ? 'flex' : 'hidden']"
                class="p-1 overflow-hidden border-0 bg-gray-200 textField justify-center items-center"
              >
                <h1 class="w-full m-0 break-words text-gray-400">
                  {{ text.result }}
                </h1>
              </div>

              <div class="w-full vuser hidden items-center mt-3 justify-center">
                <h1
                  class="bg-white text-gray-400 m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ text.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(date, index) of documents.documents.vdates" :key="index">
            <div class="absolute fields vdate select-none vuserSign">
              <div>
                <div
                  :class="[date.result ? 'hidden' : 'flex']"
                  class="signDate"
                >
                  <input
                    @change="saveDate"
                    :user_id="date.nonuser_id"
                    type="date"
                    disabled
                    class="bg-gray-200 border-0 text-gray-400"
                  />
                </div>
                <div
                  :class="[date.result ? 'flex' : 'hidden']"
                  class="p-1.5 border-0 bg-gray-200 dateSign justify-center items-center"
                >
                  <h1 class="m-0 text-gray-400">{{ date.result }}</h1>
                </div>
              </div>
              <div class="w-full vuser hidden items-center mt-3 justify-center">
                <h1
                  class="text-gray-400 bg-white m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ date.name }}
                </h1>
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
import InitialModal from "@/Components/Modals/InitialModal.vue";
import EditAside from "@/Components/Layouts/EditAside.vue";
import EditToolBar from "@/Components/Documents/EditToolBar.vue";
import Swal from "sweetalert2";
const finish = ref(false);
const toggle = ref(false);
const signatureModal = ref(null);
const signatureResult = ref(false);
const initialModal = ref(null);
import { useLoading } from "vue-loading-overlay";

const loading = useLoading({
  //   color: "#909090",
  //   loader: "dots",
  //   width: 64,
  //   height: 64,
  //   backgroundColor: "#ffffff",
  //   opacity: 1,
  //   zIndex: 999,

  color: "#ffffff",
  loader: "dots",
  width: 64,
  height: 64,
  backgroundColor: "#000000",
  opacity: 0.5,
  zIndex: 999,
});
const openText = ref(false);
const loader = ref(null);

const form = useForm({
  _method: "PUT",
  signature: "",
  doc_id: documents.documents.id,
  id: "",
  type: "text",
});
const documents = defineProps({
  documents: Object,
});
const showDoc = (doc) => {
  return `${location.origin}/${documents.documents.folder}/${doc}`;
};
const finished = () => {
  const formStatus = useForm({
    status: true,
    _method: "PUT",
    doc_id: documents.documents.id,
    user_id: documents.documents.doc_user_id,
  });
  formStatus.post(
    route("recipient.update.status.document", documents.documents.doc_res_id),
    {
      onStart: () => {
        loader.value = loading.show();
      },
      onError: () => {
        loader.value.hide();
      },
      onSuccess: () => {
        loader.value.hide();

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
          title: "This Doc is finished",
        });
      },
    }
  );
};
const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};

const closeSignatureModal = () => {
  signatureModal.value.hide();
};

const closeInitialModal = () => {
  initialModal.value.hide();
};

const closeToggle = () => {
  toggle.value = !toggle.value;
};

const saveText = (e) => {
  openText.value = false;
  form.id = e.target.getAttribute("id");
  form.post(
    route("recipient.update.document", [
      documents.documents.id,
      e.target.getAttribute("user_id"),
    ]),
    {
      onSuccess: () => {
        form.reset();
      },
    }
  );
};

const saveDate = (e) => {
  form.type = "date";
  form.id = e.target.getAttribute("id");
  form.post(
    route("recipient.update.document", [
      documents.documents.id,
      e.target.getAttribute("user_id"),
    ]),
    {
      onSuccess: () => {
        form.reset();
      },
    }
  );
};
const u_ip = ref("");
const u_city = ref("");
const u_country = ref("");
const indexs = ref(null);

const openInitialModal = (e) => {
  indexs.value = e.target.closest(".fields").getAttribute("index");
  let target = e.target.closest(".fields").querySelector(".field-container");
  if (target.classList.contains("hidden")) {
    target.classList.remove("hidden");
    e.target
      .closest(".fields")
      .querySelector(".fieldStatus")
      .classList.add("hidden");
  }

  initialModal.value.show();
};
const openSignatureModal = (e) => {
  indexs.value = e.target.closest(".fields").getAttribute("index");
  // let target = e.target.closest(".fields").querySelector(".field-container");
  // if (target.classList.contains("hidden")) {
  //   target.classList.remove("hidden");
  //   e.target
  //     .closest(".fields")
  //     .querySelector(".fieldStatus")
  //     .classList.add("hidden");
  // }
  let have;
  documents.documents.signatures.forEach((sign) => {
    if (sign.result) {
      have = sign.result;
    }
  });

  if (have) {
    const signatures = document.querySelectorAll(".signature");
    signatures[indexs.value].querySelector(".img").src = have;
    const form = useForm({
      signature: have,
      doc_id: documents.documents.id,
      id: signatures[indexs.value].querySelector(".img").getAttribute("signId"),
      type: "signature",
      _method: "PUT",
      ip: u_ip.value,
      city: u_city.value,
      country: u_country.value,
    });
    form.post(
      route("recipient.update.document", [
        signatures[indexs.value].querySelector(".img").getAttribute("id"),
        signatures[indexs.value].querySelector(".img").getAttribute("user_id"),
      ])
    );
  } else {
    signatureModal.value.show();
  }
  //   signatureResult.value = true;
};

const changeWriteStatus = (e) => {
  const main = e.target.closest(".fields");
  if (main.querySelector(".signText").classList.contains("flex")) {
    main.querySelector(".signText").classList.remove("flex");
    main.querySelector(".signText").classList.add("hidden");
    main.querySelector(".textInput").classList.remove("hidden");
    main.querySelector(".textInput").classList.add("flex");
  }
};

onMounted(() => {
  showDoc();
  const modalSignature = document.querySelector("#signature-modal");
  const modalInitial = document.querySelector("#initial-modal");
  signatureModal.value = new Modal(modalSignature);
  initialModal.value = new Modal(modalInitial);

  const mainTag = document.querySelectorAll("#main");
  const texts = document.querySelectorAll(".text");
  const signatures = document.querySelectorAll(".signature");
  const dates = document.querySelectorAll(".date");
  const initials = document.querySelectorAll(".initial");

  const vtexts = document.querySelectorAll(".vtext");
  const vsignatures = document.querySelectorAll(".vsignature");
  const vdates = document.querySelectorAll(".vdate");
  const vinitials = document.querySelectorAll(".vinitial");

  texts.forEach((text, index) => {
    text.style.top = documents.documents.texts[index].y;
    text.style.left = documents.documents.texts[index].x;
    signatureResult.value = documents.documents.texts[index].result;
    mainTag[documents.documents.texts[index].index].append(text);
  });

  signatures?.forEach((signature, index) => {
    signature.style.top = documents.documents.signatures[index]?.y;
    signature.style.left = documents.documents.signatures[index]?.x;
    signatureResult.value = documents.documents.signatures[index]?.result;
    mainTag[documents.documents.signatures[index].index].append(signature);
  });

  initials?.forEach((signature, index) => {
    signature.style.top = documents.documents.initials[index]?.y;
    signature.style.left = documents.documents.initials[index]?.x;
    signatureResult.value = documents.documents.initials[index]?.result;
    mainTag[documents.documents.initials[index].index].append(signature);
  });

  dates?.forEach((date, index) => {
    date.style.top = documents.documents.dates[index]?.y;
    date.style.left = documents.documents.dates[index]?.x;
    signatureResult.value = documents.documents.dates[index]?.result;
    mainTag[documents.documents.dates[index].index].append(date);
  });

  vtexts.forEach((text, index) => {
    text.style.top = documents.documents.vtexts[index].y;
    text.style.left = documents.documents.vtexts[index].x;
    signatureResult.value = documents.documents.vtexts[index].result;
    mainTag[documents.documents.vtexts[index].index].append(text);
  });

  vsignatures?.forEach((signature, index) => {
    signature.style.top = documents.documents.vsignatures[index]?.y;
    signature.style.left = documents.documents.vsignatures[index]?.x;
    signatureResult.value = documents.documents.vsignatures[index]?.result;
    mainTag[documents.documents.vsignatures[index].index].append(signature);
  });

  vinitials?.forEach((initial, index) => {
    initial.style.top = documents.documents.vinitials[index]?.y;
    initial.style.left = documents.documents.vinitials[index]?.x;
    signatureResult.value = documents.documents.vinitials[index]?.result;
    mainTag[documents.documents.vinitials[index].index].append(initial);
  });

  vdates?.forEach((date, index) => {
    date.style.top = documents.documents.vdates[index]?.y;
    date.style.left = documents.documents.vdates[index]?.x;
    signatureResult.value = documents.documents.vdates[index]?.result;
    mainTag[documents.documents.vdates[index].index].append(date);
  });

  initFlowbite();
  getAddress();
  const userSigns = document.querySelectorAll(".vuserSign");
  userSigns.forEach((sign) => {
    let user = sign.querySelector(".vuser");
    sign.addEventListener("mousemove", (e) => {
      if (user.classList.contains("hidden")) {
        user.classList.remove("hidden");
        user.classList.add("flex");
      }
    });
    sign.addEventListener("mouseout", (e) => {
      if (user.classList.contains("flex")) {
        user.classList.remove("flex");
        user.classList.add("hidden");
      }
    });
  });
});

const getAddress = async () => {
  let requestOptions = {
    method: "GET",
  };

  const response = await fetch(
    "https://api.geoapify.com/v1/ipinfo?&apiKey=9a20e6a383e843beb518602b73291485",
    requestOptions
  );
  const { city, country, ip } = await response.json();
  u_city.value = city.name;
  u_country.value = country.name;
  u_ip.value = ip;
};

const acceptSignature = (data) => {
  //   signatureResult.value = data;
  signatureModal.value.hide();

  const signatures = document.querySelectorAll(".signature");
  let target = signatures[indexs.value].querySelector(".field-container");
  if (target.classList.contains("hidden")) {
    target.classList.remove("hidden");
    signatures[indexs.value]
      .querySelector(".fieldStatus")
      .classList.add("hidden");
  }
  signatures[indexs.value].querySelector(".img").src = data;
  const form = useForm({
    signature: data,
    doc_id: documents.documents.id,
    id: signatures[indexs.value].querySelector(".img").getAttribute("signId"),
    type: "signature",
    _method: "PUT",
    ip: u_ip.value,
    city: u_city.value,
    country: u_country.value,
  });
  form.post(
    route("recipient.update.document", [
      signatures[indexs.value].querySelector(".img").getAttribute("id"),
      signatures[indexs.value].querySelector(".img").getAttribute("user_id"),
    ]),
    {
      onStart: () => {
        loader.value = loading.show();
      },
      onFinish: () => {
        loader.value.hide();
      },
    }
  );
};

const acceptInitial = (data) => {
  //   signatureResult.value = data;
  initialModal.value.hide();
  const initials = document.querySelectorAll(".initial");
  let target = initials[indexs.value].querySelector(".field-container");
  if (target.classList.contains("hidden")) {
    target.classList.remove("hidden");
    initials[indexs.value]
      .querySelector(".fieldStatus")
      .classList.add("hidden");
  }
  initials[indexs.value].querySelector(".img").src = data;
  const form = useForm({
    signature: data,
    doc_id: documents.documents.id,
    id: initials[indexs.value].querySelector(".img").getAttribute("signId"),
    type: "initial",
    _method: "PUT",
    ip: u_ip.value,
    city: u_city.value,
    country: u_country.value,
  });
  form.post(
    route("recipient.update.document", [
      initials[indexs.value].querySelector(".img").getAttribute("id"),
      initials[indexs.value].querySelector(".img").getAttribute("user_id"),
    ])
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
