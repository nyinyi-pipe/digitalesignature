<template>
  <div class="w-full p-4 px-3">
    <file-pond
      name="file"
      ref="pond"
      class-name="my-pond"
      label-idle="Upload and Drag and Drop
    files here..."
      accepted-file-types="image/jpeg,
    image/png"
      :server="{
        url: '',
        process: {
          url: '/profile',
          method: 'POST',
          onload: handleFileUpload,
        },
        revert: handleFileDelete,
        headers: {
          'X-CSRF-TOKEN': $page.props.csrf_token,
        },
      }"
    />
  </div>
</template>
<script setup>
import vueFilePond from "vue-filepond";
import { ref } from "vue";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import { router } from "@inertiajs/vue3";
const FilePond = vueFilePond(FilePondPluginImagePreview);

const emit = defineEmits(["uploadFile"]);
const images = ref([]);
const handleFileUpload = (response) => {
  let res = JSON.parse(response);
  images.value.push(res[0]);
  emit("uploadFile", res[1]);
  return res[0];
};
const handleFileDelete = (uniqueId, load, error) => {
  images.value = images.value.filter((img) => img != uniqueId);
  router.delete("/previewimage/" + uniqueId);
  load();
};
</script>
