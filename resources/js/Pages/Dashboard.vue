<template>
  <AuthLayout :auth="auth" title="Dashboard">
    <Head title="Dashboard" />
    <div class="p-3 shadow py-5 rounded">
      <div class="sm:flex gap-3 flex-col w-full md:flex-row justify-around">
        <div
          class="w-full sm:w-1/2 flex justify-center items-center p-3 py-5 mb-3 sm:mb-0 rounded shadow-md bg-white"
        >
          <canvas id="polarArea"></canvas>
        </div>
        <div
          class="w-full sm:w-1/2 flex justify-center items-center p-3 py-5 mb-3 sm:mb-0 rounded shadow-md bg-white"
        >
          <canvas id="line"></canvas>
        </div>
      </div>
      <Table class="mt-7 shadow py-4">
        <template #th>
          <ThCol>
            <div class="flex items-center gap-x-3">
              <button class="flex items-center gap-x-2">
                <span>No</span>

                <svg
                  class="h-3"
                  viewBox="0 0 10 11"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.1"
                  />
                  <path
                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.1"
                  />
                  <path
                    d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                    fill="currentColor"
                    stroke="currentColor"
                    stroke-width="0.3"
                  />
                </svg>
              </button>
            </div>
          </ThCol>
          <ThCol>Document Name</ThCol>
          <ThCol> Status </ThCol>
          <ThCol> Date </ThCol>
        </template>
        <template #td>
          <tr v-for="(document, index) of documents.data" :key="document.id">
            <TdCol
              class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap"
            >
              <div class="inline-flex items-center gap-x-3">
                <span>#000{{ index + 1 }}</span>
              </div>
            </TdCol>
            <TdCol>
              <Link
                href="/"
                class="inline-flex items-center px-3 py-0.5 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800"
              >
                <h2 class="text-xs font-normal">{{ document.doc_name }}</h2>
              </Link>
            </TdCol>

            <TdCol>
              <TdCol>
                <div
                  class="inline-flex items-center px-3 py-0.5 rounded-full gap-x-2"
                  :class="
                    document.doc_status == 3
                      ? 'text-green-500 bg-green-100/60'
                      : 'text-blue-500 bg-blue-100/60'
                  "
                >
                  <h2 class="text-xs font-normal">
                    {{ document.doc_status == 3 ? "Completed" : "Sent" }}
                  </h2>
                </div>
              </TdCol>
            </TdCol>
            <TdCol>
              {{ moment(document.created_at).format(" D MMM YYYY, h:mm:ss A") }}
            </TdCol>
          </tr>
        </template>
      </Table>
    </div>
  </AuthLayout>
</template>
    <script setup>
import Table from "@/Components/Table/Table.vue";
import ThCol from "@/Components/Table/ThCol.vue";
import TdCol from "@/Components/Table/TdCol.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { onMounted } from "vue";
import moment from "moment";
const { auth, documents, results } = defineProps({
  auth: Object,
  documents: Object,
  results: Array,
});
onMounted(() => {
  let [labels] = [results].map((res) => Object.keys(res));
  let [datas] = [results].map((res) => Object.values(res));

  new Chart(document.getElementById("polarArea"), {
    type: "polarArea",
    data: {
      labels: labels.map((data) => data),
      datasets: [
        {
          label: "Documents",
          data: datas.map((data) => data),
          backgroundColor: [
            "rgba(255, 205, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgb(255, 205, 86)",
            "rgb(75, 192, 192)",
            "rgb(54, 162, 235)",
            "rgb(153, 102, 255)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
    },
  });

  new Chart(document.getElementById("line"), {
    type: "bar",
    data: {
      labels: labels.map((data) => data),
      datasets: [
        {
          label: "Documents",
          data: datas.map((data) => data),
          backgroundColor: [
            "rgba(255, 205, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgb(255, 205, 86)",
            "rgb(75, 192, 192)",
            "rgb(54, 162, 235)",
            "rgb(153, 102, 255)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
    },
  });
});
</script>
