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
              <span class="text-gray-500 text-thin">1</span>
            </div>
            <div>
              <button
                @click="createPdf"
                v-if="finished"
                class="py-0.5 px-4 mr-72 rounded bg-yellow-500 text-white"
              >
                Print
              </button>
              <button
                v-else
                @click="finishPdf"
                class="py-0.5 px-4 mr-72 rounded bg-green-500 text-white"
              >
                Finish
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
                class="w-full object-cover"
                :src="doc"
                alt=""
              />

              <div id="mainCanvas" class="hidden">
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
              class="fields absolute signature select-none"
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
            </div>
          </div>

          <div v-for="(text, index) of documents.documents.texts" :key="index">
            <div class="absolute fields w-[140px] text select-none">
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
                class="border-yellow-500 p-1.5 border textField justify-center items-center"
              >
                <h1 class="m-0 text-yellow-500">{{ text.result }}</h1>
              </div>
            </div>
          </div>

          <div v-for="(date, index) of documents.documents.dates" :key="index">
            <div class="absolute fields date select-none">
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
import { onMounted, onUpdated, reactive, ref } from "vue";
import { initFlowbite, Dismiss } from "flowbite";
import EditAside from "@/Components/Layouts/EditAside.vue";
import ViewToolBar from "@/Components/Documents/ViewToolBar.vue";
import moment from "moment";
import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
// import download from "@/composables/download";
import { PDFDocument, StandardFonts, degrees, rgb } from "pdf-lib";
import download from "downloadjs";

const documents = defineProps({
  documents: Object,
  auth: Object,
});
const finished = ref(false);
const ipAdd = ref();
const res_name = ref("");

const createPdf = async () => {
  const main = document.querySelectorAll("#mainCanvas");

  // Create a new PDFDocument
  const pdfDoc = await PDFDocument.create();

  // Embed the Times Roman font
  const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRoman);

  // Add a blank page to the document

  // Get the width and height of the page
  let pdfBytes = null;
  main.forEach(async (c, i) => {
    const page = pdfDoc.addPage();

    c.classList.remove("hidden");
    const canvas = c.querySelector("#canvas");
    const img = canvas.toDataURL("image/jpeg");
    const jpgUrl = img;
    const jpgImageBytes = await fetch(jpgUrl).then((res) => res.arrayBuffer());
    const jpgImage = await pdfDoc.embedJpg(jpgImageBytes);
    const jpgDims = jpgImage.scale(1);

    // Add a blank page to the document

    // Get the width and height of the page
    page.drawImage(jpgImage, {
      x: 0,
      y: 0,
      width: c.width,
      height: c.height,
    });
    // pdfBytes = await pdfDoc.save();
  });
  main.forEach((c) => {
    c.classList.add("hidden");
  });

  // Draw a string of text toward the top of the page
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

  page.drawText("Reference number: VM3HM-YUYA8-MQTJV-SPK3K", {
    x: 30,
    y: height - 4 * 20,
    size: 10,
    font: timesRomanFont,
    color: rgb(0, 0, 0),
  });

  page.drawText("Signer", { x: 30, y: height - 4 * 35, size: 10 });
  page.drawText("Timestamp", { x: 220, y: height - 4 * 35, size: 10 });
  page.drawText("Signature", { x: 430, y: height - 4 * 35, size: 10 });

  let lineHeight = 8;
  let signer = 12;
  let signerEmail = 15;
  let sent = 19;
  let view = 22;
  let sign = 25;
  let signature = 26;
  let recipientVer = 30;
  let emailVer = 33;
  let watermask = 5;
  for (let index = 0; index < 20; index++) {
    watermask += 45;

    page.drawText("SecureSign", {
      x: 5,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 65,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 125,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 185,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 245,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 305,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 365,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 425,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 485,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
    page.drawText("SecureSign", {
      x: 545,
      y: watermask,
      size: 10,
      color: rgb(0.95, 0.1, 0.1),
      opacity: 0.2,
      rotate: degrees(-45),
    });
  }
  let requestOptions = {
    method: "GET",
  };

  const response = await fetch(
    "https://api.geoapify.com/v1/ipinfo?&apiKey=9a20e6a383e843beb518602b73291485",
    requestOptions
  );
  const { city, country, ip } = await response.json();

  for (let index = 0; index < documents.documents.signatures.length; index++) {
    const jpgUrl = documents.documents.signatures[index].result;
    const jpgImageBytes = await fetch(jpgUrl).then((res) => res.arrayBuffer());
    const jpgImage = await pdfDoc.embedPng(jpgImageBytes);
    const jpgDims = jpgImage.scale(0.5);
    lineHeight += 30;
    signer += 30;
    signerEmail += 30;
    sent += 30;
    view += 30;
    sign += 30;
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

    page.drawText(
      `${moment(documents.documents.signatures[index].created_at).format(
        "lll"
      )}`,
      {
        x: 220,
        y: height - 4 * sent,
        size: 8,
      }
    );
    page.drawText(
      `${moment(documents.documents.signatures[index].view).format("lll")}`,
      {
        x: 220,
        y: height - 4 * view,
        size: 8,
      }
    );
    page.drawText(
      `${moment(documents.documents.signatures[index].updated_at).format(
        "lll"
      )}`,
      {
        x: 220,
        y: height - 4 * sign,
        size: 8,
      }
    );

    page.drawImage(jpgImage, {
      x: 430,
      y: height - 4 * signature,
      width: 130,
      height: 65,
      opacity: 0.75,
    });

    page.drawText("Recipient Verification:", {
      x: 30,
      y: height - 4 * recipientVer,
      size: 10,
    });

    page.drawText(`IP address: ${ip}`, {
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
        "lll"
      )}`,
      {
        x: 220,
        y: height - 4 * emailVer,
        size: 8,
      }
    );

    page.drawText(`Location: ${city.name} ${country.name}`, {
      x: 430,
      y: height - 4 * emailVer,
      size: 8,
    });
  }

  page.drawText("Document completed by all parties on:", {
    x: 30,
    y: height - 4 * (lineHeight + 35),
    size: 10,
    font: timesRomanFont,
    color: rgb(0, 0, 0),
  });
  page.drawText(
    `${moment(documents.documents.finish_datetime).format("lll")}`,
    {
      x: 30,
      y: height - 4 * (lineHeight + 39),
      size: 11,
      font: timesRomanFont,
      color: rgb(0, 0, 0),
    }
  );
  // Serialize the PDFDocument to bytes (a Uint8Array)
  pdfBytes = await pdfDoc.save();

  // Trigger the browser to download the PDF document
  download(pdfBytes, `${documents.documents.doc_name}.pdf`, "application/pdf");
};

const finishPdf = () => {
  finished.value = true;
  const formStatus = useForm({
    doc_status: 3,
    _method: "PUT",
  });
  formStatus.post(
    route("document.finish.update.document", documents.documents.id)
  );
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
  window.Pusher = Pusher;
  window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
  });
  window.Echo.channel("document").listen("DocumentEvent", ({ res }) => {
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
  });
});

onMounted(() => {
  if (documents.documents.doc_status == 3) finished.value = true;
  const mainTag = document.querySelectorAll("#main");
  const texts = document.querySelectorAll(".text");
  const signatures = document.querySelectorAll(".signature");
  const dates = document.querySelectorAll(".date");

  window.Pusher = Pusher;
  window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
  });
  window.Echo.channel("document").listen("DocumentEvent", (res) => {
    axios
      .get(route("document.view.update.document", documents.documents.id))
      .then((data) => {
        const texts = document.querySelectorAll(".text");
        const signatures = document.querySelectorAll(".signature");
        const dates = document.querySelectorAll(".date");

        texts.forEach((text, index) => {
          signatureResult.value = data.data.document.texts[index].result;
        });

        signatures?.forEach((signature, index) => {
          signatureResult.value = data.data.document.signatures[index]?.result;
        });

        dates?.forEach((date, index) => {
          signatureResult.value = data.data.document.dates[index]?.result;
        });
      });
  });

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
              ctx.drawImage(
                ig,
                documents.documents.signatures[i].x.replace("px", ""),
                documents.documents.signatures[i].y.replace("px", ""),
                75,
                75
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
});
</script>
<style>
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
