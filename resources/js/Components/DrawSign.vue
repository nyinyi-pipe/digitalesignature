<template>
  <div class="w-full p-4 pb-0">
    <VueSignaturePad
      @mouseleave="$emit('saveSignature', signaturePad.saveSignature().data)"
      class="bg-gray-100"
      width="100%"
      height="300px"
      style="z-index: 1000"
      ref="signaturePad"
    />
  </div>
</template>
<script setup>
import { ref } from "vue";
import { VueSignaturePad } from "vue-signature-pad";
const signaturePad = ref(null);
</script>
