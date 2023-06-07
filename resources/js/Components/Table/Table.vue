<template>
  <section class="container px-4 mx-auto">
    <div class="flex flex-col">
      <div
        class="-mx-4 -my-2 overflow-x-auto sm:overflow-visible sm:-mx-6 lg:-mx-8"
      >
        <div class="inline-block w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="border border-gray-200 md:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <slot name="th"></slot>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <slot name="td"></slot>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div v-if="links && links.length > 0">
      <div class="flex items-center justify-end gap-1 mt-6">
        <template v-for="(link, p) in links" :key="p">
          <div
            v-if="link.url === null"
            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
            v-html="link.label"
          />

          <Link
            v-else
            class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-100 border bg-white rounded-md gap-x-2 hover:bg-gray-300"
            :class="{ 'bg-blue-700 text-white': link.active }"
            :href="link.url"
            v-html="link.label"
          />
        </template>
      </div>
    </div>
  </section>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

const { links } = defineProps(["links"]);
</script>
