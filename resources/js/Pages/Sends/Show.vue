<template>
  <Head title="Send"></Head>
  <AuthLayout :title="sendDocs.documents.doc_name">
    <div class="p-3 shadow-md py-5 bg-white rounded">
      <div class="container items-center flex justify-center mt-5">
        <div class="w-full px-3">
          <div class="flex flex-col sm:flex-row gap-5 items-center">
            <img
              class="object-cover w-36 h-32 self-start rounded"
              data-dropdown-toggle="dropdown"
              src="data:image/jpeg;base64,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"
              alt=""
            />
            <div class="flex flex-col gap-2 sm:gap-0">
              <div class="flex gap-3 items-center mb-2">
                <h1 class="text-slate-500 text-sm">Document Name:</h1>
                <div
                  class="inline-flex items-center px-3 py-0.5 rounded-3xl gap-x-2 text-red-500 bg-red-100/60"
                >
                  <h2 class="text-sm font-normal">
                    {{ sendDocs.documents.doc_name }}
                  </h2>
                </div>
              </div>
              <div class="flex gap-3 items-center mb-2">
                <h1 class="text-slate-500 text-sm">Requester Name:</h1>
                <div
                  class="inline-flex items-center px-3 py-0.5 rounded-3xl gap-x-2 text-red-500 bg-red-100/60"
                >
                  <h2 class="text-sm font-normal">
                    {{ sendDocs.documents.sends[0].requester.name }}
                  </h2>
                </div>
              </div>
              <div class="flex gap-3 items-center mb-2">
                <h1 class="text-slate-500 text-sm">Requester Email:</h1>
                <div
                  class="inline-flex items-center px-3 py-0.5 rounded-3xl gap-x-2 text-red-500 bg-red-100/60"
                >
                  <h2 class="text-sm font-normal">
                    {{ sendDocs.documents.sends[0].requester.email }}
                  </h2>
                </div>
              </div>
              <div class="flex gap-2 mt-2">
                <button
                  v-if="sendDocs.documents.doc_status == 3"
                  @click="createPdf"
                  class="py-0.5 px-3 bg-yellow-500 text-sm rounded text-white duration-300 hover:bg-yellow-600"
                >
                  Print Certificate
                </button>
                <div
                  v-else
                  class="py-0.5 px-3 bg-red-500 text-sm rounded text-white duration-300 cursor-not-allowed"
                >
                  Not Available
                </div>
                <button
                  class="py-0.5 px-3 bg-blue-500 text-sm rounded text-white duration-300 hover:bg-blue-600"
                >
                  Upload to Drive
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-7 mx-3 bg-white p-5 rounded shadow-lg">
        <ul
          class="space-y-4 text-gray-500 list-disc list-inside dark:text-gray-400"
        >
          <li>
            Recipients
            <div class="pl-5 mt-1">
              <div>
                <div class="flex items-center">
                  <h1 class="text-sm font-bold mr-3">Name:</h1>
                  <div
                    class="text-xs mr-1 m-0 py-0.5 px-3 rounded-lg bg-green-100/60 text-green-400"
                    v-for="recipient of sendDocs.documents.sends"
                    :key="recipient.recipient.id"
                  >
                    {{ recipient.recipient.name }}
                  </div>
                </div>
                <div class="flex items-center mt-2">
                  <h1 class="text-sm font-bold mr-3">Email:</h1>
                  <div
                    class="text-xs mr-1 m-0 py-0.5 px-3 rounded-lg bg-green-100/60 text-green-400"
                    v-for="recipient of sendDocs.documents.sends"
                    :key="recipient.recipient.id"
                  >
                    {{ recipient.recipient.email }}
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            CC Mails
            <div class="pl-5 mt-1">
              <div>
                <div class="flex items-center">
                  <h1 class="text-sm font-bold mr-3">Email:</h1>
                  <div
                    class="text-xs mr-1 m-0 py-0.5 px-3 rounded-lg bg-green-100/60 text-green-400"
                    v-for="mail of sendDocs.documents.sends[0].cc_mails"
                    :key="mail"
                  >
                    {{ mail }}
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <span
              class="py-0.5 px-3 bg-red-100/60 rounded-lg text-red-400 font-bold"
            >
              {{ sendDocs.documents.sends[0].subject }}
            </span>
            <div class="pl-5 mt-2 text-sm tracking-wider">
              {{ sendDocs.documents.sends[0].content }}
            </div>
          </li>
        </ul>
      </div>
    </div>
  </AuthLayout>
</template>
    <script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Table from "@/Components/Table/Table.vue";
import ThCol from "@/Components/Table/ThCol.vue";
import TdCol from "@/Components/Table/TdCol.vue";
import { Link, Head } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { PDFDocument, StandardFonts, degrees, rgb } from "pdf-lib";
import download from "downloadjs";
import moment from "moment-timezone";

const sendDocs = defineProps({
  documents: Object,
});

const createPdf = async () => {
  // Create a new PDFDocument
  const pdfDoc = await PDFDocument.create();

  // Embed the Times Roman font
  const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRoman);

  // Add a blank page to the document

  // Get the width and height of the page
  let pdfBytes = null;

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

  for (let index = 0; index < sendDocs.documents.signatures.length; index++) {
    const jpgUrl = sendDocs.documents.signatures[index].result;
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

    page.drawText(`${sendDocs.documents.signatures[index].name}`, {
      x: 30,
      y: height - 4 * signer,
      size: 11,
    });
    page.drawText(`Email: ${sendDocs.documents.signatures[index].email}`, {
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
      `${moment(sendDocs.documents.signatures[index].created_at).format(
        "D MMM YYYY, h:mm:ss A"
      )}`,
      {
        x: 220,
        y: height - 4 * sent,
        size: 8,
      }
    );
    page.drawText(
      `${moment(sendDocs.documents.signatures[index].view).format(
        "D MMM YYYY, h:mm:ss A"
      )}`,
      {
        x: 220,
        y: height - 4 * view,
        size: 8,
      }
    );
    page.drawText(
      `${moment(sendDocs.documents.signatures[index].updated_at).format(
        "D MMM YYYY, h:mm:ss A"
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

    page.drawText(`IP address: ${sendDocs.documents.signatures[index].ip}`, {
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
      `${moment(sendDocs.documents.signatures[index].created_at).format(
        "D MMM YYYY, h:mm:ss A"
      )}`,
      {
        x: 220,
        y: height - 4 * emailVer,
        size: 8,
      }
    );

    page.drawText(
      `Location: ${sendDocs.documents.signatures[index].city} ${sendDocs.documents.signatures[index].country}`,
      {
        x: 430,
        y: height - 4 * emailVer,
        size: 8,
      }
    );
  }

  page.drawText("Document completed by all parties on:", {
    x: 30,
    y: height - 4 * (lineHeight + 35),
    size: 10,
    font: timesRomanFont,
    color: rgb(0, 0, 0),
  });
  page.drawText(
    `${moment(sendDocs.documents.finish_datetime).format(
      "D MMM YYYY, h:mm:ss A"
    )}`,
    {
      x: 30,
      y: height - 4 * (lineHeight + 39),
      size: 11,
      font: timesRomanFont,
      color: rgb(0, 0, 0),
    }
  );
  console.log(sendDocs.documents.signatures[0].created_at);
  console.log(sendDocs.documents.finish_datetime);
  // Serialize the PDFDocument to bytes (a Uint8Array)
  pdfBytes = await pdfDoc.save();

  // Trigger the browser to download the PDF document
  download(pdfBytes, `${sendDocs.documents.doc_name}.pdf`, "application/pdf");
};

onMounted(() => {
  initFlowbite();
});
</script>
