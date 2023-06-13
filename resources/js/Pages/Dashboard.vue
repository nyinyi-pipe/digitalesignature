<template>
  <AuthLayout :auth="auth" title="Dashboard">
    <Head title="Dashboard" />
    <div class="p-3 shadow py-5 rounded">
      <!-- <div class="sm:flex gap-3 justify-around">
        <div class="p-3 py-5 mb-3 sm:mb-0 w-full rounded shadow-md bg-white">
          <PolarAreaChart :chartData="documentsData" />
        </div>
        <div class="p-3 py-5 mb-3 sm:mb-0 w-full rounded shadow-md bg-white">
          <BarChart :chartData="documentsData" />
        </div>
      </div> -->
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
    </div>
  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { onMounted } from "vue";
const { auth } = defineProps({
  auth: Object,
});
onMounted(() => {
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];

  new Chart(document.getElementById("polarArea"), {
    type: "polarArea",
    data: {
      labels: data.map((row) => row.year),
      datasets: [
        {
          label: "Documents by year",
          data: data.map((row) => row.count),
          backgroundColor: [
            "rgb(255, 99, 132)",
            "rgb(75, 192, 192)",
            "rgb(255, 205, 86)",
            "rgb(0, 255, 187)",
            "rgb(19, 255, 2)",
          ],
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
      labels: data.map((row) => row.year),
      datasets: [
        {
          label: "Documents by year",
          data: data.map((row) => row.count),
          backgroundColor: [
            "rgb(255, 99, 132)",
            "rgb(75, 192, 192)",
            "rgb(255, 205, 86)",
            "rgb(0, 255, 187)",
            "rgb(19, 255, 2)",
          ],
        },
      ],
    },
    options: {
      responsive: true,
    },
  });
});
</script>
