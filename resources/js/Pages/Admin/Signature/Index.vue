<template>
  <AuthLayout title="Manage Signature">
    <div class="p-3 shadow-md py-5 rounded">
      <div class="px-4">
        <div class="relative flex">
          <div
            class="py-1.5 cursor-pointer flex items-center gap-2 text-sm lg:text-md px-3 bg-green-500 text-white rounded-md mb-5"
            data-modal-target="authentication-modal"
            data-modal-toggle="authentication-modal"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15"
              />
            </svg>

            Add Signature
          </div>
        </div>

        <!-- Main modal -->
        <div
          id="authentication-modal"
          tabindex="-1"
          aria-hidden="true"
          class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
          <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-xl">
              <button
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="authentication-modal"
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
              <div class="px-2 sm:px-6 py-6 lg:px-8">
                <h3
                  class="mb-4 px-3 sm:px-0 text-xl font-medium text-green-900 dark:text-white"
                >
                  Create Signatures
                </h3>

                <div
                  class="border-b sm:mb-3 border-gray-200 dark:border-gray-700 h-80 sm:h-96"
                >
                  <ul
                    class="flex justify-center sm:justify-start -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                  >
                    <li class="mr-2">
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
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                          />
                        </svg>

                        Draw
                      </label>

                      <div
                        class="absolute bg-white shadow-lg left-0 p-6 border mt-5 border-indigo-300 rounded-lg w-[90%] ml-[4%] transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1"
                      >
                        <img
                          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrIqjellmZfEmjcAOiI-r5WxERqj4wanQgxw&usqp=CAU"
                          class="object-cover bg-white"
                          style=""
                          alt=""
                        />
                      </div>
                    </li>
                    <li class="mr-2">
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
                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                          />
                        </svg>

                        Upload
                      </label>

                      <div
                        class="absolute bg-white shadow-lg left-0 p-6 border mt-5 border-indigo-300 rounded-lg w-[90%] ml-[4%] mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1"
                      >
                        <div class="flex items-center justify-center w-full">
                          <label
                            for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-green-300 border-dashed rounded-lg cursor-pointer bg-green-50 dark:hover:bg-bray-800 dark:bg-green-700 hover:bg-green-100 dark:border-green-600 dark:hover:border-green-500 dark:hover:bg-green-600"
                          >
                            <div
                              class="flex flex-col items-center justify-center pt-5 pb-6"
                            >
                              <svg
                                aria-hidden="true"
                                class="w-10 h-10 mb-3 text-green-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                ></path>
                              </svg>
                              <p
                                class="mb-2 text-sm text-green-500 dark:text-green-400"
                              >
                                <span class="font-semibold"
                                  >Click to upload</span
                                >
                                or drag and drop
                              </p>
                              <p
                                class="text-xs text-green-500 dark:text-green-400"
                              >
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                              </p>
                            </div>
                            <input
                              id="dropzone-file"
                              type="file"
                              class="hidden"
                            />
                          </label>
                        </div>
                      </div>
                    </li>
                    <li class="mr-2">
                      <input
                        class="peer sr-only inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                        type="radio"
                        value="yesno"
                        name="answer"
                        id="yesno"
                      />
                      <label
                        class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-b-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out"
                        for="yesno"
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
                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z"
                          />
                        </svg>

                        Type
                      </label>

                      <div
                        class="absolute bg-white shadow-lg left-0 p-6 border mt-5 border-indigo-300 rounded-lg w-[90%] ml-[4%] mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1"
                      >
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Tempore modi repellendus rerum, aliquam error quae
                        assumenda porro eum. Repellendus magnam ab mollitia
                        itaque. Laborum, pariatur maiores explicabo ea veniam
                        placeat.
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div
                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
              >
                <button
                  data-modal-hide="authentication-modal"
                  type="button"
                  class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800"
                >
                  Save
                </button>
                <button
                  data-modal-hide="authentication-modal"
                  type="button"
                  class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                >
                  Cancel
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Table>
        <template #th>
          <ThCol>
            <div class="flex items-center gap-x-3">
              <input
                type="checkbox"
                class="text-green-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"
              />
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
          <ThCol>Signature</ThCol>
          <ThCol> Action </ThCol>
        </template>
        <template #td>
          <tr>
            <TdCol
              class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap"
            >
              <div class="inline-flex items-center gap-x-3">
                <input
                  type="checkbox"
                  class="text-green-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"
                />

                <span>#0001</span>
              </div>
            </TdCol>
            <TdCol>
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrIqjellmZfEmjcAOiI-r5WxERqj4wanQgxw&usqp=CAU"
                class="w-20 h-10 object-cover"
                alt=""
              />
            </TdCol>

            <TdCol>
              <div class="flex gap-2">
                <div
                  class="cursor-pointer inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-blue-500 bg-blue-100/60 dark:bg-gray-800"
                >
                  <h2 class="text-sm font-normal">Edit</h2>
                </div>
                <div
                  class="cursor-pointer inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800"
                >
                  <h2 class="text-sm font-normal">Delete</h2>
                </div>
              </div>
            </TdCol>
          </tr>
        </template>
      </Table>
    </div>
  </AuthLayout>
</template>
<script setup>
import { initFlowbite } from "flowbite";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Table from "@/Components/Table/Table.vue";
import ThCol from "@/Components/Table/ThCol.vue";
import TdCol from "@/Components/Table/TdCol.vue";
import { onMounted } from "vue";
onMounted(() => {
  initFlowbite();
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d");

  ctx.fillStyle = "#E2E8F0";
  ctx.fillRect(10, 10, 500, 300);
});
</script>
