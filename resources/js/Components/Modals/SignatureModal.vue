<template>
  <div
    id="signature-modal"
    tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden p-3 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-xs shadow-xl">
        <button
          @click="$emit('closeSignatureModal')"
          type="button"
          class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
        >
          <svg
            aria-hidden="true"
            class="w-5 h-5"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>

        <div class="px-2 sm:px-6 py-6 pb-0">
          <h3
            class="mb-4 px-3 sm:px-0 text-xl font-medium text-green-900 dark:text-white"
          >
            Create Signatures
          </h3>

          <div class="sm:mb-3 border-gray-200 h-80 sm:h-96">
            <ul
              class="flex shadow-md justify-center sm:justify-start -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
            >
              <li class="mr-2" @click="Upload">
                <input
                  class="peer sr-only inline-flex p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500 group"
                  type="radio"
                  value="yes"
                  name="answer"
                  id="yes"
                  checked
                />
                <label
                  class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-b-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out"
                  for="yes"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 mr-2 text-green-600 dark:text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                    />
                  </svg>

                  Upload
                </label>
              </li>
              <li class="mr-2" @click="Draw">
                <input
                  class="peer sr-only inline-flex p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500 group"
                  type="radio"
                  value="no"
                  name="answer"
                  id="no"
                />
                <label
                  class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-b-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out"
                  for="no"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 mr-2 text-green-600 dark:text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                    />
                  </svg>
                  Draw
                </label>
              </li>
            </ul>

            <transition>
              <keep-alive>
                <component
                  :is="selectedComponent"
                  @saveSignature="saveSignature"
                ></component>
              </keep-alive>
            </transition>
          </div>
        </div>
        <div class="flex justify-between px-6 py-3 border-t">
          <button
            @click="$emit('closeSignatureModal')"
            type="button"
            class="text-gray-500 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded border border-gray-200 text-sm font-medium px-6 py-1.5 hover:text-gray-900 focus:z-10"
          >
            Cancel
          </button>
          <button
            type="button"
            @click="$emit('acceptSignature', signature)"
            class="text-white duration-200 bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-sm inline-flex items-center px-6 py-1.5 text-center mr-2"
          >
            Accept and sign
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onBeforeMount, onMounted, onActivated, ref } from "vue";
import DrawSign from "@/Components/DrawSign.vue";
import UploadSign from "@/Components/UploadSign.vue";
const selectedComponent = ref(UploadSign);
const signature = ref(null);

const Draw = () => {
  selectedComponent.value = DrawSign;
};
const Upload = () => {
  selectedComponent.value = UploadSign;
};
const saveSignature = (data) => {
  signature.value = data;
};
</script>
