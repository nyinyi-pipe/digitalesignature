<template>
  <Head title="Inputs"></Head>
  <AuthLayout :auth="auth" title="Inputs">
    <div class="py-5 bg-white px-2">
      <ul
        class="w-full divide-y divide-gray-200"
        v-for="input of inputs"
        :key="input.id"
      >
        <li
          v-if="input.document"
          class="w-full border p-2 px-3 hover:shadow duration-300 transition-shadow hover:bg-gray-100 cursor-pointer"
        >
          <Link
            :href="route('input.show', input.id)"
            class="flex space-x-10 w-full"
          >
            <h3 class="text-sm font-bold w-[10%]">
              {{ input.recipient.name }}
            </h3>
            <div class="flex w-full gap-2 flex-nowrap overflow-hidden">
              <h5 class="text-sm font-bold flex-none">
                {{ input.document.doc_name }}
              </h5>
              <p class="font-light text-sm text-gray-400 flex-none">
                {{ input.content }}
              </p>
            </div>
          </Link>
        </li>
      </ul>
      <div v-if="!inputs.length">
        <p class="text-red-500 text-center font-bold">Not Found Inputs</p>
      </div>
    </div>
  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link, Head } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
const { inputs, auth } = defineProps({
  inputs: Array,
  auth: Object,
});
onMounted(() => {
  initFlowbite();
  console.log(inputs);
});
</script>
