<template>
  <AuthLayout title="Dashboard">
    <Head title="Dashboard" />
    <div class="p-3 shadow py-5 rounded">
      <div class="sm:flex gap-3 justify-around">
        <div class="p-3 py-5 mb-3 sm:mb-0 w-full rounded shadow-md bg-white">
          <PolarAreaChart :chartData="documentsData" />
        </div>
        <div class="p-3 py-5 mb-3 sm:mb-0 w-full rounded shadow-md bg-white">
          <BarChart :chartData="documentsData" />
        </div>
      </div>
    </div>
  </AuthLayout>
</template>
<script setup>
import { defineComponent } from "vue";
import { PolarAreaChart, BarChart, DoughnutChart } from "vue-chart-3";
import { Chart, registerables } from "chart.js";
Chart.register(...registerables);

import AuthLayout from "@/Layouts/AuthLayout.vue";
import Table from "@/Components/Table/Table.vue";
import ThCol from "@/Components/Table/ThCol.vue";
import TdCol from "@/Components/Table/TdCol.vue";
import { Link, Head } from "@inertiajs/vue3";

const documentsData = {
  labels: ["Paris", "Nîmes", "Toulon", "Perpignan", "Autre"],
  datasets: [
    {
      data: [30, 40, 60, 70, 5],
      backgroundColor: [
        "rgb(255, 99, 132)",
        "rgb(75, 192, 192)",
        "rgb(255, 205, 86)",
        "rgb(0, 255, 187)",
        "rgb(19, 255, 2)",
      ],
    },
  ],
};
</script>
