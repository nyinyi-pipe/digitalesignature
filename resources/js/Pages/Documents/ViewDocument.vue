<template>
  <Head title="Document" />
  <EditAside
    :auth="documents.auth.user"
    :toggle="toggle"
    @closeToggle="closeToggle"
  ></EditAside>

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
                <p class="view"></p>
                <p class="text-yellow-600 font-thin text-xs">View</p>
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
          <div class="relative">
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
                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
              />
            </svg>
            <p
              :class="[noti ? 'block' : 'hidden']"
              class="h-2 w-2 rounded-full bg-blue-500 absolute top-[-12%] right-[9%]"
            ></p>
          </div>
        </div>
      </div>
    </div>
    <div
      :class="[noti ? 'block transition-opacity  duration-500' : 'hidden']"
      class="w-full fixed z-50 top-12 right-2 max-w-xs p-4 pb-3 text-gray-500 bg-white rounded-sm shadow"
      role="alert"
    >
      <div class="flex items-center">
        <div
          class="inline-flex items-center justify-center flex-shrink-0 w-7 h-7 text-blue-500 bg-blue-100 rounded-lg"
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
              d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <span class="sr-only">Refresh icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">
          <span class="mb-1 text-sm font-semibold text-gray-900"
            >{{ res_name }} Updated</span
          >
        </div>
        <button
          type="button"
          @click="closeAlert"
          class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        >
          <span class="sr-only">Close</span>
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
        </button>
      </div>
    </div>

    <div class="flex relative">
      <div
        class="sm:w-[63%] pb-16 h-screen md:w-[70%] lg:w-[75%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed bg-white px-5 flex user-select-none"
          style="z-index: 20"
        >
          <div class="flex justify-between w-full py-1.5 gap-2 pr-5">
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
              <span class="text-gray-500 text-thin">{{
                documents.documents.doc_docs.length
              }}</span>
            </div>
            <div>
              <button
                v-if="!finished"
                @click="finishPdf"
                class="py-0.5 px-4 mr-72 rounded bg-green-500 text-white"
              >
                Finish
              </button>
              <button
                v-else
                @click="createPdf"
                class="py-0.5 px-4 mr-72 rounded bg-yellow-500 text-white"
              >
                Print
              </button>
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
            <div class="relative main" id="main">
              <img
                id="image"
                :index="index"
                :doc="doc"
                class="w-full relative top-0 z-20 object-cover"
                :src="doc"
                alt=""
              />

              <div id="mainCanvas" class="absolute top-0 z-10">
                <canvas
                  id="canvas"
                  class="mt-3 w-full object-cover"
                  :height="height(doc)"
                  :width="width(doc)"
                ></canvas>
              </div>
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.signatures"
            :key="index"
          >
            <div
              draggable="true"
              class="fields absolute z-50 signature select-none userSign"
              :index="index"
            >
              <div
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
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
                class="border imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="sign.id"
                  :user_id="sign.user_id"
                />
              </div>
              <div class="w-full user hidden items-center mt-3 justify-center">
                <h1
                  class="text-blue-500 m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ sign.name }}
                </h1>
              </div>
            </div>
          </div>

          <div
            v-for="(initial, index) of documents.documents.initials"
            :key="index"
          >
            <div
              draggable="true"
              class="fields absolute initial z-50 select-none userSign"
              :index="index"
            >
              <div
                :class="[initial.result ? 'hidden' : 'flex']"
                class="border signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
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
                :class="[initial.result ? 'flex' : 'hidden']"
                class="border imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[initial.result ?? initialResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="initial.id"
                  :user_id="initial.user_id"
                />
              </div>
              <div class="w-full user hidden items-center mt-3 justify-center">
                <h1
                  class="text-blue-500 m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ initial.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(text, index) of documents.documents.texts" :key="index">
            <div
              class="absolute z-50 fields w-[140px] text select-none userSign"
            >
              <div
                @click="changeWriteStatus"
                :class="[text.result ? 'hidden' : 'flex']"
                class="border signText items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-yellow-600 bg-transparent border-yellow-600"
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
              <div
                :class="[text.result ? 'flex' : 'hidden']"
                class="border-yellow-500 p-1 overflow-hidden border textField justify-center items-center"
              >
                <h1 class="w-full m-0 text-yellow-500 break-words">
                  {{ text.result }}
                </h1>
              </div>

              <div class="w-full user hidden items-center mt-3 justify-center">
                <h1
                  class="text-yellow-500 m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ text.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(date, index) of documents.documents.dates" :key="index">
            <div class="absolute z-50 fields date select-none userSign">
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
                    class="border-pink-600 text-sm text-pink-600 bg-transparent"
                  />
                </div>
                <div
                  :class="[date.result ? 'flex' : 'hidden']"
                  class="border-pink-500 p-1.5 border dateSign justify-center items-center"
                >
                  <h1 class="m-0 text-pink-500">{{ date.result }}</h1>
                </div>
              </div>
              <div class="w-full user hidden items-center mt-3 justify-center">
                <h1
                  class="text-red-500 m-0 w-auto px-3 shadow-lg rounded-xl text-sm"
                >
                  {{ date.name }}
                </h1>
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
import { Link, router, Head, useForm } from "@inertiajs/vue3";
import { onBeforeMount, onMounted, onUpdated, reactive, ref } from "vue";
import { initFlowbite, Dismiss } from "flowbite";
import EditAside from "@/Components/Layouts/EditAside.vue";
import ViewToolBar from "@/Components/Documents/ViewToolBar.vue";
import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
// import download from "@/composables/download";
import { PDFDocument, StandardFonts, degrees, rgb } from "pdf-lib";
import download from "downloadjs";
import moment from "moment-timezone";
import { useLoading } from "vue-loading-overlay";

const loading = useLoading({
  color: "#ffffff",
  loader: "dots",
  width: 64,
  height: 64,
  backgroundColor: "#000000",
  opacity: 0.5,
  zIndex: 999,
});

const loader = ref(null);

const documents = defineProps({
  documents: Object,
  auth: Object,
  reference: String,
});
const finished = ref(false);
const ipAdd = ref();
const res_name = ref("");
const createPdf = async () => {
  loader.value = loading.show();
  const main = document.querySelectorAll("#mainCanvas");
  const pdfDoc = await PDFDocument.create();
  const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRomanBold);
  let pdfBytes = null;

  main.forEach(async (c, i) => {
    const pages = pdfDoc.addPage();
    const canvas = c.querySelector("#canvas");
    const img = canvas.toDataURL("image/jpeg");
    const jpgUrl = img;
    const jpgImageBytes = await fetch(jpgUrl).then((res) => res.arrayBuffer());
    const imageType = await pdfDoc.embedJpg(jpgImageBytes);
    let jpgImage =
      imageType != null ? imageType : await pdfDoc.embedPng(jpgImageBytes);
    let jpgDims;
    if (parseFloat(c.querySelector("canvas").width) > 1000) {
      jpgDims = jpgImage.scale(0.3);
      pages.drawImage(jpgImage, {
        // x: page.getWidth() / 2 - jpgDims.width / 2,
        // y: page.getHeight() / 2 - jpgDims.height / 2 + 250,
        x: 0,
        y: 0,
        width: jpgDims.width,
        height: jpgDims.height,
      });
    } else {
      jpgDims = jpgImage.scale(1);
      pages.drawImage(jpgImage, {
        x: 0,
        y: 0,
        width: jpgDims.width,
        height: jpgDims.height,
      });
    }
  });

  const page = pdfDoc.addPage();
  const { width, height } = page.getSize();

  const fontSize = 30;
  page.drawText("Signature Certificate", {
    x: 30,
    y: height - 4 * 13,
    size: fontSize,
    font: timesRomanFont,
    color: rgb(0, 0, 0),
  });

  let reference = "Reference number: " + documents.reference;
  page.drawText(reference, {
    x: 30,
    y: height - 4 * 20,
    size: 10,
    color: rgb(0, 0, 0),
  });

  page.drawText("Signer", {
    x: 30,
    y: height - 4 * 35,
    size: 10,
    font: timesRomanFont,
  });
  page.drawText("Timestamp", {
    x: 220,
    y: height - 4 * 35,
    size: 10,
    font: timesRomanFont,
  });
  page.drawText("Signature", {
    x: 430,
    y: height - 4 * 35,
    size: 10,
    font: timesRomanFont,
  });

  let lineHeight = 8;
  let signer = 12;
  let signerEmail = 15;
  let sent = 19;
  let view = 22;
  let sign = 25;
  let initial = 28;
  let signature = 26;
  let recipientVer = 33;
  let emailVer = 36;
  let watermask = 5;
  for (let index = 0; index < 20; index++) {
    watermask += 45;

    page.drawText("SecureSign", {
      x: 5,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 65,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 125,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 185,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 245,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 305,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 365,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 425,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 485,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 545,
      y: watermask,
      size: 10,
      color: rgb(0.1, 0.95, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
  }
  let signatures = [];
  for (let index = 0; index < documents.documents.signatures.length; index++) {
    if (!signatures.includes(documents.documents.signatures[index].email)) {
      signatures.push(documents.documents.signatures[index].email);

      const jpgUrl = documents.documents.signatures[index].result;
      const jpgImageBytes = await fetch(jpgUrl).then((res) =>
        res.arrayBuffer()
      );
      const jpgImage = await pdfDoc.embedPng(jpgImageBytes);
      const jpgDims = jpgImage.scale(0.5);
      lineHeight += 30;
      signer += 30;
      signerEmail += 30;
      sent += 30;
      view += 30;
      sign += 30;
      initial += 30;
      signature += 30;
      recipientVer += 30;
      emailVer += 30;

      page.drawLine({
        start: { x: 25, y: height - 4 * lineHeight },
        end: { x: 570, y: height - 4 * lineHeight },
        thickness: 0.3,
        color: rgb(0, 0, 0),
        opacity: 0.55,
      });

      page.drawText(`${documents.documents.signatures[index].name}`, {
        x: 30,
        y: height - 4 * signer,
        size: 11,
        font: timesRomanFont,
      });
      page.drawText(`Email: ${documents.documents.signatures[index].email}`, {
        x: 30,
        y: height - 4 * signerEmail,
        size: 9,
      });

      page.drawText("Sent:", {
        x: 30,
        y: height - 4 * sent,
        size: 8,
      });
      page.drawText("Viewed:", {
        x: 30,
        y: height - 4 * view,
        size: 8,
      });
      page.drawText("Signed:", {
        x: 30,
        y: height - 4 * sign,
        size: 8,
      });
      page.drawText("Initial By:", {
        x: 30,
        y: height - 4 * initial,
        size: 8,
      });

      page.drawText(
        `${moment(documents.documents.signatures[index].created_at).format(
          "D MMM YYYY, h:mm:ss A"
        )}`,
        {
          x: 220,
          y: height - 4 * sent,
          size: 8,
        }
      );
      page.drawText(
        `${moment(documents.documents.signatures[index].view).format(
          "D MMM YYYY, h:mm:ss A"
        )}`,
        {
          x: 220,
          y: height - 4 * view,
          size: 8,
        }
      );
      page.drawText(
        `${moment(documents.documents.signatures[index].updated_at).format(
          "D MMM YYYY, h:mm:ss A"
        )}`,
        {
          x: 220,
          y: height - 4 * sign,
          size: 8,
        }
      );

      let initialby = documents.documents.signatures[index].connect ?? "";
      page.drawText(`${initialby}`, {
        x: 220,
        y: height - 4 * initial,
        size: 8,
      });

      page.drawImage(jpgImage, {
        x: 430,
        y: height - 4 * signature,
        width: 120,
        height: 60,
        opacity: 0.75,
      });

      page.drawText("Recipient Verification:", {
        x: 30,
        y: height - 4 * recipientVer,
        size: 10,
        font: timesRomanFont,
      });

      page.drawText(`IP address: ${documents.documents.signatures[index].ip}`, {
        x: 430,
        y: height - 4 * recipientVer,
        size: 8,
      });

      page.drawText("Email verified ", {
        x: 30,
        y: height - 4 * emailVer,
        size: 8,
      });

      page.drawText(
        `${moment(documents.documents.signatures[index].created_at).format(
          "D MMM YYYY, h:mm:ss A"
        )}`,
        {
          x: 220,
          y: height - 4 * emailVer,
          size: 8,
        }
      );

      page.drawText(
        `Location: ${documents.documents.signatures[index].city} ${documents.documents.signatures[index].country}`,
        {
          x: 430,
          y: height - 4 * emailVer,
          size: 8,
        }
      );
    }
  }

  page.drawText("Document completed by all parties on:", {
    x: 30,
    y: height - 4 * (lineHeight + 37),
    size: 10,
    color: rgb(0, 0, 0),
  });
  page.drawText(
    `${moment(documents.documents.finish_datetime)
      .tz("Asia/Yangon")
      .format("D MMM YYYY, h:mm:ss A")}`,
    {
      x: 30,
      y: height - 4 * (lineHeight + 41),
      size: 11,
      color: rgb(0, 0, 0),
    }
  );

  const jpgUrl =
    "data:image/png;base64,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";
  const jpgImageBytes = await fetch(jpgUrl).then((res) => res.arrayBuffer());
  const imageType = await pdfDoc.embedPng(jpgImageBytes);
  let jpgImage =
    imageType != null ? imageType : await pdfDoc.embedPng(jpgImageBytes);
  const jpgDims = jpgImage.scale(1);
  page.drawImage(jpgImage, {
    x: 30,
    y: 40,
    width: 60,
    height: 60,
  });

  page.drawText("Certificate by SecureSign", {
    x: 105,
    y: 77,
    font: timesRomanFont,
    size: 12,
    color: rgb(0, 0, 0),
  });

  page.drawText("SecureSign is a document workflow and certified ", {
    x: 105,
    y: 60,
    size: 9,
    color: rgb(0, 0, 0),
  });
  // }
  // Serialize the PDFDocument to bytes (a Uint8Array)
  pdfBytes = await pdfDoc.save();

  // Trigger the browser to download the PDF document
  loader.value.hide();
  download(pdfBytes, `${documents.documents.doc_name}.pdf`, "application/pdf");
};

const finishPdf = async () => {
  let pdfBytes = null;
  loader.value = loading.show();

  try {
    const main = document.querySelectorAll("#mainCanvas");
    const pdfDoc = await PDFDocument.create();
    const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRomanBold);

    main.forEach(async (c, i) => {
      const pages = pdfDoc.addPage();
      const canvas = c.querySelector("#canvas");
      const img = canvas.toDataURL("image/jpeg");
      const jpgUrl = img;
      const jpgImageBytes = await fetch(jpgUrl).then((res) =>
        res.arrayBuffer()
      );
      const imageType = await pdfDoc.embedJpg(jpgImageBytes);
      let jpgImage =
        imageType != null ? imageType : await pdfDoc.embedPng(jpgImageBytes);
      let jpgDims;
      if (parseFloat(c.querySelector("canvas").width) > 1000) {
        jpgDims = jpgImage.scale(0.3);
        pages.drawImage(jpgImage, {
          x: page.getWidth() / 2 - jpgDims.width / 2,
          y: page.getHeight() / 2 - jpgDims.height / 2 + 250,
          width: jpgDims.width,
          height: jpgDims.height,
        });
      } else {
        jpgDims = jpgImage.scale(1);
        pages.drawImage(jpgImage, {
          x: 0,
          y: 0,
          width: jpgDims.width,
          height: jpgDims.height,
        });
      }
    });

    const page = pdfDoc.addPage();
    const { width, height } = page.getSize();

    const fontSize = 30;
    page.drawText("Signature Certificate", {
      x: 30,
      y: height - 4 * 13,
      size: fontSize,
      font: timesRomanFont,
      color: rgb(0, 0, 0),
    });

    let reference = "Reference number: " + documents.reference;
    page.drawText(reference, {
      x: 30,
      y: height - 4 * 20,
      size: 10,
      color: rgb(0, 0, 0),
    });

    page.drawText("Signer", {
      x: 30,
      y: height - 4 * 35,
      size: 10,
      font: timesRomanFont,
    });
    page.drawText("Timestamp", {
      x: 220,
      y: height - 4 * 35,
      size: 10,
      font: timesRomanFont,
    });
    page.drawText("Signature", {
      x: 430,
      y: height - 4 * 35,
      size: 10,
      font: timesRomanFont,
    });

    let lineHeight = 8;
    let signer = 12;
    let signerEmail = 15;
    let sent = 19;
    let view = 22;
    let sign = 25;
    let initial = 28;
    let signature = 26;
    let recipientVer = 33;
    let emailVer = 36;
    let watermask = 5;
    for (let index = 0; index < 20; index++) {
      watermask += 45;

      page.drawText("SecureSign", {
        x: 5,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 65,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 125,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 185,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 245,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 305,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 365,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 425,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 485,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
      page.drawText("SecureSign", {
        x: 545,
        y: watermask,
        size: 10,
        color: rgb(0.1, 0.95, 0.1),
        opacity: 0.2,
        rotate: degrees(-45),
      });
    }
    let signatures = [];
    for (
      let index = 0;
      index < documents.documents.signatures.length;
      index++
    ) {
      if (!signatures.includes(documents.documents.signatures[index].email)) {
        signatures.push(documents.documents.signatures[index].email);

        const jpgUrl = documents.documents.signatures[index].result;
        const jpgImageBytes = await fetch(jpgUrl).then((res) =>
          res.arrayBuffer()
        );
        const jpgImage = await pdfDoc.embedPng(jpgImageBytes);
        const jpgDims = jpgImage.scale(0.5);
        lineHeight += 30;
        signer += 30;
        signerEmail += 30;
        sent += 30;
        view += 30;
        sign += 30;
        initial += 30;
        signature += 30;
        recipientVer += 30;
        emailVer += 30;

        page.drawLine({
          start: { x: 25, y: height - 4 * lineHeight },
          end: { x: 570, y: height - 4 * lineHeight },
          thickness: 0.3,
          color: rgb(0, 0, 0),
          opacity: 0.55,
        });

        page.drawText(`${documents.documents.signatures[index].name}`, {
          x: 30,
          y: height - 4 * signer,
          size: 11,
          font: timesRomanFont,
        });
        page.drawText(`Email: ${documents.documents.signatures[index].email}`, {
          x: 30,
          y: height - 4 * signerEmail,
          size: 9,
        });

        page.drawText("Sent:", {
          x: 30,
          y: height - 4 * sent,
          size: 8,
        });
        page.drawText("Viewed:", {
          x: 30,
          y: height - 4 * view,
          size: 8,
        });
        page.drawText("Signed:", {
          x: 30,
          y: height - 4 * sign,
          size: 8,
        });
        page.drawText("Initial By:", {
          x: 30,
          y: height - 4 * initial,
          size: 8,
        });

        page.drawText(
          `${moment(documents.documents.signatures[index].created_at).format(
            "D MMM YYYY, h:mm:ss A"
          )}`,
          {
            x: 220,
            y: height - 4 * sent,
            size: 8,
          }
        );
        page.drawText(
          `${moment(documents.documents.signatures[index].view).format(
            "D MMM YYYY, h:mm:ss A"
          )}`,
          {
            x: 220,
            y: height - 4 * view,
            size: 8,
          }
        );
        page.drawText(
          `${moment(documents.documents.signatures[index].updated_at).format(
            "D MMM YYYY, h:mm:ss A"
          )}`,
          {
            x: 220,
            y: height - 4 * sign,
            size: 8,
          }
        );

        let initialby = documents.documents.signatures[index].connect ?? "";
        page.drawText(`${initialby}`, {
          x: 220,
          y: height - 4 * initial,
          size: 8,
        });

        page.drawImage(jpgImage, {
          x: 430,
          y: height - 4 * signature,
          width: 120,
          height: 60,
          opacity: 0.75,
        });

        page.drawText("Recipient Verification:", {
          x: 30,
          y: height - 4 * recipientVer,
          size: 10,
          font: timesRomanFont,
        });

        page.drawText(
          `IP address: ${documents.documents.signatures[index].ip}`,
          {
            x: 430,
            y: height - 4 * recipientVer,
            size: 8,
          }
        );

        page.drawText("Email verified ", {
          x: 30,
          y: height - 4 * emailVer,
          size: 8,
        });

        page.drawText(
          `${moment(documents.documents.signatures[index].created_at).format(
            "D MMM YYYY, h:mm:ss A"
          )}`,
          {
            x: 220,
            y: height - 4 * emailVer,
            size: 8,
          }
        );

        page.drawText(
          `Location: ${documents.documents.signatures[index].city} ${documents.documents.signatures[index].country}`,
          {
            x: 430,
            y: height - 4 * emailVer,
            size: 8,
          }
        );
      }
    }

    page.drawText("Document completed by all parties on:", {
      x: 30,
      y: height - 4 * (lineHeight + 37),
      size: 10,
      color: rgb(0, 0, 0),
    });
    page.drawText(
      `${moment(documents.documents.finish_datetime)
        .tz("Asia/Yangon")
        .format("D MMM YYYY, h:mm:ss A")}`,
      {
        x: 30,
        y: height - 4 * (lineHeight + 41),
        size: 11,
        color: rgb(0, 0, 0),
      }
    );

    const jpgUrl =
      "data:image/png;base64,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";
    const jpgImageBytes = await fetch(jpgUrl).then((res) => res.arrayBuffer());
    const imageType = await pdfDoc.embedPng(jpgImageBytes);
    let jpgImage =
      imageType != null ? imageType : await pdfDoc.embedPng(jpgImageBytes);
    const jpgDims = jpgImage.scale(1);
    page.drawImage(jpgImage, {
      x: 30,
      y: 40,
      width: 60,
      height: 60,
    });
    page.drawText("Certificate by SecureSign", {
      x: 105,
      y: 77,
      font: timesRomanFont,
      size: 12,
      color: rgb(0, 0, 0),
    });

    page.drawText("SecureSign is a document workflow and certified ", {
      x: 105,
      y: 60,
      size: 9,
      color: rgb(0, 0, 0),
    });

    pdfBytes = await pdfDoc.saveAsBase64();
    let fileData = dataURLtoFile(
      "data:application/pdf;base64," + pdfBytes,
      documents.documents.doc_name
    );

    finished.value = true;
    const formStatus = useForm({
      doc_status: 3,
      _method: "PUT",
      file: fileData,
    });

    formStatus.post(
      route("document.finish.update.document", documents.documents.id),
      {
        onStart: () => {
          loader.value = loading.show();
        },
        onError: () => {
          loader.value.hide();
        },
        onSuccess: () => {
          location.reload();
        },
      }
    );
  } catch (error) {
    location.reload();
  }

  function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(","),
      mime = arr[0].match(/:(.*?);/)[1],
      bstr = atob(arr[1]),
      n = bstr.length,
      u8arr = new Uint8Array(n);

    while (n--) {
      u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, { type: mime });
  }
};
const height = (doc) => {
  const img = new Image();
  img.src = doc;
  return img.naturalHeight;
};
const width = (doc) => {
  const img = new Image();
  img.src = doc;
  return img.naturalWidth;
};
const noti = ref(false);
const toggle = ref(false);
const uploadedDocument = ref("");
const date = ref("");
const signatureResult = ref(null);
const initialResult = ref(null);

const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};
const closeAlert = () => {
  noti.value = false;
};

const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};

moment(documents.documents.updated_at).format("ll");
onUpdated(() => {
  const mainTag = document.querySelectorAll("#main");
  const texts = document.querySelectorAll(".text");
  const signatures = document.querySelectorAll(".signature");
  const dates = document.querySelectorAll(".date");
  const initials = document.querySelectorAll(".initial");

  window.Pusher = Pusher;
  window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
  });
  window.Echo.private(`document.${documents.documents.user_id}`).listen(
    "DocumentEvent",
    ({ res }) => {
      axios
        .get(route("document.view.update.document", documents.documents.id))
        .then((data) => {
          noti.value = true;
          res_name.value = res.name + " " + res.type;
          texts.forEach((text, index) => {
            if (text.style.top == data.data.document.texts[index].y) {
              if (data.data.document.texts[index].result) {
                text.querySelector(".signText").classList.add("hidden");
                text.querySelector(".textField").classList.remove("hidden");
                text.querySelector("h1").innerText =
                  data.data.document.texts[index].result;
              }
            }
          });

          signatures?.forEach((signature, index) => {
            if (signature.style.top == data.data.document.signatures[index].y) {
              if (data.data.document.signatures[index].result) {
                signature.querySelector(".signImg").classList.add("hidden");
                signature.querySelector(".imgSign").classList.remove("hidden");
                signature.querySelector(".img").src =
                  data.data.document.signatures[index].result;
              }
            }
          });

          initials?.forEach((initial, index) => {
            if (initial.style.top == data.data.document.initials[index].y) {
              if (data.data.document.initials[index].result) {
                initial.querySelector(".signImg").classList.add("hidden");
                initial.querySelector(".imgSign").classList.remove("hidden");
                initial.querySelector(".img").src =
                  data.data.document.initials[index].result;
              }
            }
          });

          dates?.forEach((date, index) => {
            if (date.style.top == data.data.document.dates[index].y) {
              if (data.data.document.dates[index].result) {
                date.querySelector(".signDate").classList.add("hidden");
                date.querySelector(".dateSign").classList.remove("hidden");
                date.querySelector("h1").innerText =
                  data.data.document.dates[index].result;
              }
            }
          });
        });
    }
  );
});

onMounted(() => {
  if (documents.documents.doc_status == 3) finished.value = true;
  const mainTag = document.querySelectorAll("#main");
  const texts = document.querySelectorAll(".text");
  const signatures = document.querySelectorAll(".signature");
  const dates = document.querySelectorAll(".date");
  const initials = document.querySelectorAll(".initial");

  //   window.Pusher = Pusher;
  //   window.Echo = new Echo({
  //     broadcaster: "pusher",
  //     key: import.meta.env.VITE_PUSHER_APP_KEY,
  //     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  //     forceTLS: true,
  //   });
  //   window.Echo.private(`document.${documents.auth.user.id}`).listen(
  //     "DocumentEvent",
  //     (res) => {
  //       axios
  //         .get(route("document.view.update.document", documents.documents.id))
  //         .then((data) => {
  //           const texts = document.querySelectorAll(".text");
  //           const signatures = document.querySelectorAll(".signature");
  //           const dates = document.querySelectorAll(".date");
  //           const initials = document.querySelectorAll(".initial");

  //           texts.forEach((text, index) => {
  //             signatureResult.value = data.data.document.texts[index].result;
  //           });

  //           signatures?.forEach((signature, index) => {
  //             signatureResult.value =
  //               data.data.document.signatures[index]?.result;
  //           });

  //           dates?.forEach((date, index) => {
  //             signatureResult.value = data.data.document.dates[index]?.result;
  //           });

  //           initials?.forEach((initial, index) => {
  //             signatureResult.value = data.data.document.initials[index]?.result;
  //           });
  //         });
  //     }
  //   );

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

  initials?.forEach((initial, index) => {
    initial.style.top = documents.documents.initials[index]?.y;
    initial.style.left = documents.documents.initials[index]?.x;
    signatureResult.value = documents.documents.initials[index]?.result;
    mainTag[documents.documents.initials[index].index].append(initial);
  });

  dates?.forEach((date, index) => {
    date.style.top = documents.documents.dates[index]?.y;
    date.style.left = documents.documents.dates[index]?.x;
    signatureResult.value = documents.documents.dates[index]?.result;
    mainTag[documents.documents.dates[index].index].append(date);
  });

  date.value = `Updated ${moment(documents.documents.updated_at).format("ll")}`;
  uploadedDocument.value =
    location.origin + "/storage/documents/" + documents.documents.doc_docs;

  initFlowbite();
  const certificate = document.querySelector("#certificate");
  mainTag.innerHTML += certificate;

  const canvas = document.querySelectorAll("#canvas");
  canvas.forEach((img, index) => {
    const ctx = img.getContext("2d");
    const image = new Image();
    image.onload = () => {
      ctx.drawImage(image, 0, 0);
      if (documents.documents.signatures) {
        documents.documents.signatures.forEach((sign, i) => {
          if (sign.index == index) {
            const ig = new Image();
            ig.onload = () => {
              let width =
                img.getBoundingClientRect().width /
                parseFloat(
                  documents.documents.signatures[i].x.replace("px", "")
                );
              let height =
                img.getBoundingClientRect().height /
                parseFloat(
                  documents.documents.signatures[i].y.replace("px", "")
                );
              ctx.drawImage(
                ig,
                img.width / width,
                img.height / height,
                120,
                70
              );
            };
            ig.src = sign.result;
          }
        });
      }

      if (documents.documents.initials) {
        documents.documents.initials.forEach((sign, i) => {
          if (sign.index == index) {
            const ig = new Image();
            ig.onload = () => {
              ctx.drawImage(
                ig,
                documents.documents.initials[i].x.replace("px", ""),
                documents.documents.initials[i].y.replace("px", ""),
                120,
                70
              );
            };
            ig.src = sign.result;
          }
        });
      }

      if (documents.documents.texts) {
        documents.documents.texts.forEach((text, i) => {
          if (text.index == index) {
            ctx.font = "16px serif";
            text.result &&
              ctx.fillText(
                text.result,
                documents.documents.texts[i].x.replace("px", ""),
                documents.documents.texts[i].y.replace("px", "")
              );
          }
        });
      }

      if (documents.documents.dates) {
        documents.documents.dates.forEach((date, i) => {
          if (date.index == index) {
            ctx.font = "16px serif";
            date.result &&
              ctx.fillText(
                date.result,
                documents.documents.dates[i].x.replace("px", ""),
                documents.documents.dates[i].y.replace("px", "")
              );
          }
        });
      }
    };
    image.src = documents.documents.doc_docs[index];
  });

  const userSigns = document.querySelectorAll(".userSign");
  userSigns.forEach((sign) => {
    let user = sign.querySelector(".user");
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
</script>
<style scoped>
.view {
  width: 10px;
  height: 10px;
  background-color: rgb(255, 243, 19);
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
