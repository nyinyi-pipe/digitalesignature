<template>
  <div class="mt-8">
    <h3 class="text-xs text-gray-400 mb-3 uppercase">Connect Initials</h3>

    <div class="flex">
      <label for="sign_state" class="sr-only">Connect Initial</label>
      <select
        id="sign_state"
        class="bg-gray-50 border text-xs bg-teal-100/50 border-gray-300 text-gray-600 rounded-l border-l focus:ring-teal-500 focus:border-teal-500 block w-full p-1.5"
        v-model="toSign"
      >
        <option selected>From Connect</option>
        <template v-for="recipient of recipients" :key="recipient.id">
          <option :value="recipient.email">{{ recipient.name }}</option>
        </template>
      </select>
      <label for="states" class="sr-only">Connect Initial</label>
      <select
        id="states"
        class="bg-gray-50 border text-xs border-gray-300 text-gray-600 rounded-r border-l-gray-100 border-l focus:ring-teal-500 focus:border-teal-500 block w-full p-1.5"
        v-model="selectConnect"
      >
        <option selected>To Connect</option>
        <template v-for="recipient of recipients" :key="recipient.id">
          <option :value="recipient.email">{{ recipient.name }}</option>
        </template>
      </select>
    </div>
    <template v-if="toSign != 'From Connect' && selectConnect != 'To Connect'">
      <button
        @click="saveConnection"
        :class="[
          connect == 'Connected'
            ? ' bg-gray-200 cursor-not-allowed  text-gray-500'
            : 'bg-teal-500 hover:bg-teal-400 cursor-pointer hover:text-black text-white',
        ]"
        class="py-1 w-full px-3 mt-2 border rounded text-sm transition-colors duration-200"
      >
        {{ connect }}
      </button>
    </template>
  </div>
</template>
<script setup>
import { onMounted, onUpdated, ref } from "vue";
const { recipients } = defineProps({
  recipients: Array,
});
const emit = defineEmits(["signConnection"]);
const selectConnect = ref("To Connect");
const connect = ref("Connect");

const toSign = ref("From Connect");
const saveConnection = () => {
  emit("signConnection", {
    fromConnect: toSign.value,
    toConnect: selectConnect.value,
  });
  connect.value = "Connected";
};
onMounted(() => {});
</script>
