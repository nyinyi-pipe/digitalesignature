<template>
  <div>
    <VueSignaturePad
      class="bg-gray-100"
      width="100%"
      height="300px"
      ref="signaturePad"
    />
    <h1 id="test"></h1>
  </div>
</template>
<script setup>
import { VueSignaturePad } from "vue-signature-pad";

import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: "pusher",
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
});
window.Echo.channel("channel-name").listen("Test", (para) => {
  document.querySelector("#test").innerText = para.text;
  console.log(para);
});
</script>
