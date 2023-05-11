<template>
  <Head title="Document" />
  <EditAside :toggle="toggle" @closeToggle="closeToggle"></EditAside>
  <div class="h-screen overflow-hidden">
    <!-- new document modal -->
    <NewDocumentName
      :form="form"
      @closeMailModal="closeMailModal"
      @saveDocumentName="saveDocumentName"
    />
    <!-- mail modal -->
    <MailModal
      :auth="documents.auth"
      :document="documents.documents"
      @closeSendMailModal="closeSendMailModal"
    />

    <div
      class="sticky z-10 top-0 h-14 border-b bg-white flex items-center py-2 lg:py-2.5"
    >
      <div
        class="px-6 flex items-center w-full justify-between space-x-4 2xl:container"
      >
        <div class="flex gap-3 items-center justify-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-slate-500 cursor-pointer"
            @click="toggleAside"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>

          <div>
            <h3 class="font-bold text-sm mb-1">
              {{ documents.documents.doc_name }}
            </h3>
            <div class="flex items-center gap-3">
              <div class="flex items-center mr-2">
                <p class="sent"></p>
                <p class="text-indigo-600 font-thin text-xs">Sent</p>
              </div>
              <ul class="list-disc flex gap-7 items-center">
                <li class="flex">
                  <h5 class="text-xs font-thin text-gray-500">
                    {{ date }}
                  </h5>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button
            id="invite"
            data-dropdown-toggle="invite-dropdown"
            class="focus:outline-none rounded text-sm border focus:border-0 peer-focus:ring-0 px-4 py-1.5 shadow-md hover:bg-gray-100 hover:shadow-0 duration-200 text-center inline-flex items-center"
            type="button"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 text-green-600 font-bold mr-1"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
              />
            </svg>

            <span class="text-green-600 font-bold">Invite</span>
          </button>
          <!-- Invite Dropdown menu -->
          <div
            id="invite-dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow-lg w-44 dark:bg-gray-700"
          >
            <ul
              class="text-sm text-gray-700 dark:text-gray-200"
              aria-labelledby="invite"
            >
              <li>
                <a
                  href="#"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >Share via link</a
                >
              </li>
            </ul>
          </div>
          <!-- data-modal-target="popup-modal"
            data-modal-toggle="popup-modal" -->
          <button
            @click="openEmailModal"
            class="focus:outline-none rounded bg-green-600 text-sm focus:border-0 peer-focus:ring-0 px-5 py-1.5 shadow-md hover:shadow-0 duration-200 text-center inline-flex items-center"
          >
            <span class="text-white font-bold">Send</span>
          </button>

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
              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
          </svg>

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
              d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
            />
          </svg>

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
              d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
            />
          </svg>
        </div>
      </div>
    </div>
    <div class="flex relative">
      <div
        class="sm:w-[63%] md:w-[70%] lg:w-[76%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed mb-3 bg-white px-5 flex user-select-none"
          style="z-index: 20"
        >
          <div class="border-r flex py-1.5 gap-2 pr-3">
            <div class="flex items-center gap-1 px-1.5 rounded h-7 bg-gray-100">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-gray-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                />
              </svg>
              <span class="text-gray-500 text-thin">1</span>
            </div>
            <div
              class="flex items-center gap-1 px-1.5 rounded h-7 duration-200 cursor-pointer hover:bg-gray-100"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 text-gray-500"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m6-6H6"
                />
              </svg>

              <span class="text-gray-500 font-bold text-sm">Document</span>
            </div>
          </div>
          <div class="flex items-center gap-1 px-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5 text-gray-400"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75"
              />
            </svg>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5 text-gray-500"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
              />
            </svg>
          </div>
        </div>
        <div
          class="px-5 my-5 h-full relative flex flex-col justify-center items-center"
          style="z-index: 10"
        >
          <div class="w-full">
            <h1 class="mt-2 font-bold">{{ documents.documents.doc_name }}</h1>
            <div class="flex justify-between w-full items-center mb-2">
              <div>
                <h1 class="text-gray-500 text-xs">1 page</h1>
              </div>
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 rounded-full hover:bg-gray-300 duration-200 text-gray-500 cursor-pointer"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6v12m6-6H6"
                  />
                </svg>
              </div>
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 rounded-full hover:bg-gray-300 duration-200 text-gray-500 cursor-pointer"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                  />
                </svg>
              </div>
            </div>
          </div>
          <div class="relative overflow-hidden" id="main">
            <img
              id="image"
              @drop="onDrop"
              class="w-full object-cover"
              :src="uploadedDocument"
              alt=""
            />
          </div>

          <div v-for="(signature, index) of signatures" :key="index">
            <div
              draggable="true"
              @dragstart="editSignature"
              class="absolute fields hidden signature select-none"
              name="signature"
              data-modal-target="signatureModal"
              data-modal-toggle="signatureModal"
              :count="index"
            >
              <div
                class="cursor-pointer px-2 py-1.5 m-0 mb-2 text-sm text-white bg-gray-800"
              >
                <div class="flex gap-2 items-center">
                  <div class="flex items-center pr-2 border-r">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 mr-2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                      />
                    </svg>
                    <span class="font-bold">Assign</span>
                  </div>
                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-red-600"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 border-dashed m-0 font-thin text-sm text-green-600 bg-transparent border-green-600"
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
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
                <span>Signature</span>
              </div>
            </div>
          </div>

          <div v-for="(text, index) of texts" :key="index">
            <div
              draggable="true"
              @dragstart="editText"
              class="absolute fields hidden text select-none"
              name="text"
              :count="index"
            >
              <div
                class="cursor-pointer px-2 py-1.5 m-0 mb-2 text-sm text-white bg-gray-800"
              >
                <div class="flex gap-2 items-center">
                  <div class="flex items-center pr-2 border-r">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 mr-2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                      />
                    </svg>
                    <span class="font-bold">Assign</span>
                  </div>
                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-red-600"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                      />
                    </svg>
                  </div>
                </div>
              </div>
              <div
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 border-dashed m-0 font-thin text-sm text-green-600 bg-transparent border-green-600"
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
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
                <span>Text</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="sm:w-[37%] md:w-[30%] lg:w-[24%] h-screen flex"
        style="z-index: 20"
      >
        <div class="border-r border-l w-[16%] py-3 h-full flex justify-center">
          <div class="">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              title="Content"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5 bg-blue-500 cursor-pointer text-white rounded-full"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 6v12m6-6H6"
              />
            </svg>
          </div>
        </div>
        <aside class="h-full w-full px-3 py-2">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-md font-bold">Content</h2>
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
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </div>
          <h3 class="text-xs text-gray-400 mb-3">BLOCKS</h3>
          <div class="flex flex-wrap gap-2 relative">
            <div
              draggable="true"
              id="text"
              @dragstart="increaseText"
              class="drag-field w-[48%] overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 flex justify-between"
            >
              <div class="drag-style h-full bg-green-100"></div>
              <div
                class="field-container p-3 pb-5 pt-2 flex justify-between w-full"
              >
                <h5 class="text-xs font-bold">Text</h5>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5 text-gray-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
                  />
                </svg>
              </div>
            </div>

            <div
              draggable="true"
              id="signature"
              @dragstart="increaseSignature"
              class="drag-field overflow-hidden user-select-none duration-500 border border-green-200 border-dashed bg-green-50 w-[48%] flex justify-between"
            >
              <div class="drag-style h-full bg-green-100"></div>
              <div
                class="field-container p-3 pb-5 pt-2 flex justify-between w-full"
              >
                <h5 class="text-xs font-bold">Signature</h5>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5 text-gray-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
              </div>
            </div>
          </div>
          <div>
            <h3 class="text-xs text-gray-400 mb-3 my-5">FILLABLE FIELDS FOR</h3>
            <div class="relative">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 absolute left-0 bottom-1.5 text-gray-400"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                />
              </svg>

              <input
                type="text"
                placeholder="Start typing name or email"
                class="p-1 text-sm text-gray-400 pl-7 border-0 border-b w-full peer-focus:border-0 focus:ring-0"
              />
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 absolute right-0 bottom-1.5 text-gray-400"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                />
              </svg>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link, router, Head } from "@inertiajs/vue3";
import { onMounted, reactive, ref } from "vue";
import { initFlowbite, Modal } from "flowbite";
import MailModal from "@/Components/Modals/MailModal.vue";
import NewDocumentName from "@/Components/Modals/NewDocumentName.vue";
import EditAside from "@/Components/Layouts/EditAside.vue";
import moment from "moment";
import axios from "axios";

const documents = defineProps({
  documents: Object,
  auth: Object,
});

const form = reactive({
  newDocumentName: null,
});

const sendMailForm = reactive({
  sendMail: null,
});
const mails = reactive(["list", "of", "options"]);

const toggle = ref(false);
const uploadedDocument = ref("");
const signatures = ref([]);
const texts = ref([]);
const signatureEdit = ref(null);
const TextEdit = ref(null);
const signatureEditStatus = ref(false);
const TextEditStatus = ref(false);
const dragText = ref("");
const date = ref("");
const documentNameModal = ref(null);
const sendModal = ref(null);

const openEmailModal = () => {
  documentNameModal.value.show();
};

const openSendMailModal = () => {
  sendModal.value.show();
};

const closeMailModal = () => {
  documentNameModal.value.hide();
};

const closeSendMailModal = () => {
  sendModal.value.hide();
};

const saveDocumentName = async () => {
  const { data } = await axios.put(
    route("document.new.document-name", documents.documents.id),
    form
  );
  documents.documents = data.documents;
  documentNameModal.value.hide();
  openSendMailModal();
};
const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};

const editSignature = (e) => {
  signatureEdit.value = e.target.getAttribute("count");
  signatureEditStatus.value = !signatureEditStatus.value;
};

const editText = (e) => {
  TextEdit.value = e.target.getAttribute("count");
  TextEditStatus.value = !TextEditStatus.value;
};

const increaseSignature = () => {
  signatures.value.push(signatures.value.length);
  dragText.value = "signature";
};
moment(documents.documents.updated_at).format("ll");

const increaseText = () => {
  texts.value.push(texts.value.length);
  dragText.value = "text";
};

const onDrop = (e) => {
  e.preventDefault();
  const documentSignatureFieldsContainer =
    document.querySelectorAll(".signature");
  const documentTextFieldsContainer = document.querySelectorAll(".text");

  const documentSignatureField =
    documentSignatureFieldsContainer[signatures.value.length - 1];
  const documentTextField = documentTextFieldsContainer[texts.value.length - 1];

  if (
    !signatureEditStatus.value &&
    documentSignatureField &&
    dragText.value == "signature"
  ) {
    if (
      documentSignatureField.getAttribute("count") ==
      signatures.value[signatures.value.length - 1]
    ) {
      documentSignatureField.classList.remove("hidden");
      documentSignatureField.style.top = `${e.offsetY}px`;
      documentSignatureField.style.left = `${e.offsetX}px`;
    }
  } else if (signatureEditStatus.value && !TextEditStatus.value) {
    const editSignatureField =
      documentSignatureFieldsContainer[signatureEdit.value];
    if (
      editSignatureField &&
      editSignatureField.getAttribute("count") == signatureEdit.value
    ) {
      editSignatureField.style.top = `${e.offsetY}px`;
      editSignatureField.style.left = `${e.offsetX}px`;
    }
    signatureEditStatus.value = !signatureEditStatus.value;
  } else if (
    !TextEditStatus.value &&
    documentTextField &&
    dragText.value == "text"
  ) {
    if (
      documentTextField.getAttribute("count") ==
      texts.value[texts.value.length - 1]
    ) {
      documentTextField.classList.remove("hidden");
      documentTextField.style.top = `${e.offsetY}px`;
      documentTextField.style.left = `${e.offsetX}px`;
    }
  } else if (TextEditStatus.value && !signatureEditStatus.value) {
    const editTextField = documentTextFieldsContainer[TextEdit.value];
    if (
      editTextField &&
      editTextField.getAttribute("count") == TextEdit.value
    ) {
      editTextField.style.top = `${e.offsetY}px`;
      editTextField.style.left = `${e.offsetX}px`;
    }
    TextEditStatus.value = !TextEditStatus.value;
  }
};
const deleteField = (e) => {
  const name = e.target.closest(".fields").getAttribute("name");
  const target = e.target.closest(`.${name}`);
  target.classList.add("hidden");
  target.style.top = `0px`;
  target.style.left = `0px`;
};

onMounted(() => {
  const modalDocument = document.querySelector("#changeDocumentName");
  const modalMail = document.querySelector("#sendMailModal");
  documentNameModal.value = new Modal(modalDocument);
  sendModal.value = new Modal(modalMail);
  date.value = `Updated ${moment(documents.documents.updated_at).format("ll")}`;
  uploadedDocument.value =
    location.origin + "/storage/documents/" + documents.documents.doc_docs;
  form.newDocumentName = documents.documents.doc_name;

  const image = document.querySelector("#image");

  image.addEventListener(
    "dragover",
    (e) => {
      e.preventDefault();
    },
    false
  );
  initFlowbite();
});
</script>
<style>
.sent {
  width: 10px;
  height: 10px;
  background-color: rgb(53, 53, 255);
  border-radius: 50%;
  margin-right: 5px;
}

.drag-field:hover {
  cursor: move;
}
.drag-field:hover svg {
  display: none;
}

.drag-field:hover .drag-style {
  width: 14%;
}
</style>
