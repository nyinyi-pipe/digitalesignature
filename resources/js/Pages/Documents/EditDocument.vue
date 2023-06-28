<template>
  <Head title="Document" />
  <EditAside
    :auth="documents.auth.user"
    :toggle="toggle"
    @closeToggle="closeToggle"
  ></EditAside>
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
      :signConnects="signConnects"
      @closeSendMailModal="closeSendMailModal"
      :recipientEmails="recipientEmails"
    />
    <!-- signature modal -->
    <SignatureModal
      @acceptSignature="acceptSignature"
      @closeSignatureModal="closeSignatureModal"
    />
    <!-- new document modal -->
    <NewDocumentUpload
      @closeNewDocumentUpload="closeNewDocumentUpload"
      :id="documents.documents.id"
    />
    <!-- new recipient modal -->
    <NewRecipientModal
      :documents="documents.documents"
      @closeNewRecipientModal="closeNewRecipientModal"
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
          <!-- <button
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
            </button> -->
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
        class="sm:w-[63%] pb-16 h-screen md:w-[70%] lg:w-[76%] mx-auto bg-gray-100 overflow-scroll"
      >
        <div
          class="w-full fixed bg-white px-5 flex user-select-none"
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
              @click="openNewDocumentUpload"
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
          class="px-5 w-full mt-10 md:w-[87%] lg:w-[86%] mx-auto relative flex flex-col justify-center items-center"
          style="z-index: 10"
        >
          <h1 class="mt-2 -mb-5 font-bold w-full">
            {{ documents.documents.doc_name }}
          </h1>
          <div
            v-for="(doc, index) of documents.documents.doc_docs"
            :key="index"
          >
            <div class="w-full mt-6">
              <div class="flex justify-between w-full items-center mb-2">
                <div>
                  <h1 class="text-gray-500 text-xs">{{ index + 1 }} page</h1>
                </div>
                <div class="addDocs">
                  <svg
                    :data-dropdown-toggle="dropdownnewdoc + index"
                    type="button"
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

                  <div
                    :id="dropdownnewdoc + index"
                    @click="openNewDocumentUpload"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-xs shadow w-39"
                  >
                    <ul
                      class="py-1 text-sm text-gray-700 dark:text-gray-200"
                      aria-labelledby="dropdownDefaultButton"
                    >
                      <li>
                        <button
                          href="#"
                          class="px-4 py-1 w-full gap-1.5 items-center hover:bg-gray-100 flex"
                        >
                          <svg
                            height="21"
                            viewBox="0 0 21 21"
                            width="21"
                            class="h-5 w-5 font-bold text-gray-500"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <g
                              fill="none"
                              fill-rule="evenodd"
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              transform="translate(4 3)"
                            >
                              <path d="m2.5 4.753 4-4.232 4 4.191" />
                              <path d="m6.5.5v11" />
                              <path d="m.5 14.5h12" />
                            </g>
                          </svg>
                          <span class="text-gray-500">Upload File</span>
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
                <div>
                  <svg
                    data-dropdown-toggle="dropdown-delete-doc"
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
                  <div
                    id="dropdown-delete-doc"
                    class="z-10 hidden bg-white rounded-sm shadow w-39"
                  >
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                      <li
                        @click="deleteDocument(doc)"
                        :doc="doc"
                        class="px-2 py-1 flex gap-2 text-gray-500 hover:text-red-500 duration-300 hover:bg-gray-100 items-center cursor-pointer"
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
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                          />
                        </svg>
                        Delete page
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="relative" id="main">
              <img
                id="image"
                :index="index"
                :doc="doc"
                class="w-full object-cover"
                :src="doc"
                alt=""
              />
            </div>
          </div>

          <div v-for="(signature, index) of signatures" :key="index">
            <div
              :doc="signature"
              :index="index"
              types="signature"
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
                  <div
                    @click="assignRecipent"
                    class="flex items-center pr-2 border-r"
                  >
                    <svg
                      v-if="recipientName == 'Assign' && nameStatus"
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
                    <svg
                      v-else
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-3.5 h-3.5 mr-1.5 mb-0.5 text-blue-500 bg-blue-500 rounded-full"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span
                      class="font-bold text-gray-200"
                      id="recipientName"
                      :recipientEmail="recipientEmail"
                      >{{ recipientName }}</span
                    >
                  </div>

                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-gray-200"
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
                v-if="!signatureResult"
                @click="openSignatureModal"
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g
                    fill="none"
                    fill-rule="evenodd"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    transform="translate(3 3)"
                  >
                    <path
                      d="m14 1c.8284271.82842712.8284271 2.17157288 0 3l-9.5 9.5-4 1 1-3.9436508 9.5038371-9.55252193c.7829896-.78700064 2.0312313-.82943964 2.864366-.12506788z"
                    />
                    <path d="m6.5 14.5h8" />
                    <path d="m12.5 3.5 1 1" />
                  </g>
                </svg>
                <span>Signature</span>
              </div>
              <div
                v-else
                @click="openSignatureModal"
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img :src="signatureResult" alt="" class="h-8 w-8" />
              </div>
              <div
                class="shadow rounded-sm mt-1.5 bg-white hidden"
                id="recipients"
              >
                <div
                  v-for="(recipient, index) of documents.documents.recipients"
                  :key="index"
                >
                  <div
                    class="px-2 recipient flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-200"
                    @click="chooseRecipients"
                  >
                    <img
                      src="https://media.istockphoto.com/id/1393750072/vector/flat-white-icon-man-for-web-design-silhouette-flat-illustration-vector-illustration-stock.jpg?s=612x612&w=0&k=20&c=s9hO4SpyvrDIfELozPpiB_WtzQV9KhoMUP9R9gVohoU="
                      class="w-6 h-6 rounded-full"
                      alt=""
                    />
                    <div id="recipientContainer">
                      <h5 class="m-0 text-xs font-bold recipientName">
                        {{ recipient.name }}
                      </h5>
                      <h4
                        class="m-0 text-xs font-thin text-slate-500 recipientEmail"
                      >
                        {{ recipient.email }}
                      </h4>
                    </div>
                  </div>
                </div>
                <div
                  @click="openNewRecipientModal"
                  class="px-2 flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 rounded-full text-center text-green-500 bg-green-100 p-1"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                    />
                  </svg>

                  <div>
                    <h5 class="m-0 text-xs font-bold text-green-500">
                      Add recipient
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-for="(initial, index) of initials" :key="index">
            <div
              :doc="initial"
              :index="index"
              types="initial"
              draggable="true"
              @dragstart="editInitial"
              class="absolute fields hidden initial select-none"
              name="initial"
              data-modal-target="initialModal"
              data-modal-toggle="initialModal"
              :count="index"
            >
              <div
                class="cursor-pointer px-2 py-1.5 m-0 mb-2 text-sm text-white bg-gray-800"
              >
                <div class="flex gap-2 items-center">
                  <div
                    @click="initialAssignRecipent"
                    class="flex items-center pr-2 border-r"
                  >
                    <svg
                      v-if="recipientName == 'Assign' && nameStatus"
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
                    <svg
                      v-else
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-3.5 h-3.5 mr-1.5 mb-0.5 text-blue-500 bg-blue-500 rounded-full"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span
                      class="font-bold text-gray-200"
                      id="recipientName"
                      :recipientEmail="recipientEmail"
                      >{{ recipientName }}</span
                    >
                  </div>

                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-gray-200"
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
                v-if="!signatureResult"
                @click="openSignatureModal"
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g
                    fill="none"
                    fill-rule="evenodd"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    transform="translate(3 3)"
                  >
                    <path
                      d="m14 1c.8284271.82842712.8284271 2.17157288 0 3l-9.5 9.5-4 1 1-3.9436508 9.5038371-9.55252193c.7829896-.78700064 2.0312313-.82943964 2.864366-.12506788z"
                    />
                    <path d="m6.5 14.5h8" />
                    <path d="m12.5 3.5 1 1" />
                  </g>
                </svg>
                <span>Initial</span>
              </div>
              <div
                v-else
                @click="openInitialModal"
                class="border flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img :src="initialResult" alt="" class="h-8 w-8" />
              </div>
              <div
                class="shadow rounded-sm mt-1.5 bg-white hidden"
                id="recipients"
              >
                <div
                  v-for="(recipient, index) of documents.documents.recipients"
                  :key="index"
                >
                  <div
                    class="px-2 recipient flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-200"
                    @click="chooseInitialRecipients"
                  >
                    <img
                      src="https://media.istockphoto.com/id/1393750072/vector/flat-white-icon-man-for-web-design-silhouette-flat-illustration-vector-illustration-stock.jpg?s=612x612&w=0&k=20&c=s9hO4SpyvrDIfELozPpiB_WtzQV9KhoMUP9R9gVohoU="
                      class="w-6 h-6 rounded-full"
                      alt=""
                    />
                    <div id="recipientContainer">
                      <h5 class="m-0 text-xs font-bold recipientName">
                        {{ recipient.name }}
                      </h5>
                      <h4
                        class="m-0 text-xs font-thin text-slate-500 recipientEmail"
                      >
                        {{ recipient.email }}
                      </h4>
                    </div>
                  </div>
                </div>
                <div
                  @click="openNewRecipientModal"
                  class="px-2 flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 rounded-full text-center text-green-500 bg-green-100 p-1"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                    />
                  </svg>

                  <div>
                    <h5 class="m-0 text-xs font-bold text-green-500">
                      Add recipient
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-for="(text, index) of texts" :key="index">
            <div
              draggable="true"
              @dragstart="editText"
              class="absolute fields hidden w-[140px] text select-none"
              name="text"
              types="text"
              :count="index"
              :doc="text"
              :index="index"
            >
              <div
                class="cursor-pointer px-2 py-1.5 m-0 mb-2 text-sm text-white bg-gray-800"
              >
                <div class="flex gap-2 items-center">
                  <div
                    @click="textAssignRecipent"
                    class="flex items-center pr-2 border-r"
                  >
                    <svg
                      v-if="recipientName == 'Assign' && nameStatus"
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
                    <svg
                      v-else
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-3.5 h-3.5 mr-1.5 mb-0.5 text-blue-500 bg-blue-500 rounded-full"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span
                      class="font-bold text-gray-200"
                      id="recipientName"
                      :recipientEmail="recipientEmail"
                      >{{ recipientName }}</span
                    >
                  </div>

                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-gray-200"
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
                @click="changeWriteStatus"
                class="border signText flex items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-yellow-600 bg-transparent border-yellow-600"
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
              <div class="textInput hidden">
                <input
                  type="text"
                  placeholder="something..."
                  class="p-0 py-1.5 px-2 w-full focus:ring-yellow-600 border-yellow-600 hover:border-yellow-600 focus:border-yellow-600 focus:outline-none"
                />
              </div>
              <div
                class="shadow rounded-sm mt-1.5 bg-white hidden"
                id="recipients"
              >
                <div
                  v-for="(recipient, index) of documents.documents.recipients"
                  :key="index"
                >
                  <div
                    class="px-2 recipient flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-200"
                    @click="chooseTextRecipients"
                  >
                    <img
                      src="https://media.istockphoto.com/id/1393750072/vector/flat-white-icon-man-for-web-design-silhouette-flat-illustration-vector-illustration-stock.jpg?s=612x612&w=0&k=20&c=s9hO4SpyvrDIfELozPpiB_WtzQV9KhoMUP9R9gVohoU="
                      class="w-6 h-6 rounded-full"
                      alt=""
                    />
                    <div id="recipientContainer">
                      <h5 class="m-0 text-xs font-bold recipientName">
                        {{ recipient.name }}
                      </h5>
                      <h4
                        class="m-0 text-xs font-thin text-slate-500 recipientEmail"
                      >
                        {{ recipient.email }}
                      </h4>
                    </div>
                  </div>
                </div>
                <div
                  @click="openNewRecipientModal"
                  class="px-2 flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 rounded-full text-center text-green-500 bg-green-100 p-1"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                    />
                  </svg>

                  <div>
                    <h5 class="m-0 text-xs font-bold text-green-500">
                      Add recipient
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-for="(date, index) of dates" :key="index">
            <div
              draggable="true"
              @dragstart="dateEdit"
              class="absolute fields date select-none"
              name="date"
              types="date"
              :count="index"
              :doc="date"
              :index="index"
            >
              <div
                class="cursor-pointer px-2 py-1.5 m-0 mb-2 text-sm text-white bg-gray-800"
              >
                <div class="flex gap-2 items-center">
                  <div
                    @click="dateAssignRecipent"
                    class="flex items-center pr-2 border-r"
                  >
                    <svg
                      v-if="recipientName == 'Assign' && nameStatus"
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
                    <svg
                      v-else
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-3.5 h-3.5 mr-1.5 mb-0.5 text-blue-500 bg-blue-500 rounded-full"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span
                      class="font-bold text-gray-200"
                      id="recipientName"
                      :recipientEmail="recipientEmail"
                      >{{ recipientName }}</span
                    >
                  </div>

                  <div>
                    <svg
                      @click="deleteField"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5 text-gray-200"
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
              <div class="">
                <input
                  type="date"
                  class="border-pink-600 text-sm text-pink-600 bg-transparent"
                />
              </div>
              <div></div>
              <div
                class="shadow rounded-sm mt-1.5 bg-white hidden"
                id="recipients"
              >
                <div
                  v-for="(recipient, index) of documents.documents.recipients"
                  :key="index"
                >
                  <div
                    class="px-2 recipient flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-200"
                    @click="chooseDateRecipients"
                  >
                    <img
                      src="https://media.istockphoto.com/id/1393750072/vector/flat-white-icon-man-for-web-design-silhouette-flat-illustration-vector-illustration-stock.jpg?s=612x612&w=0&k=20&c=s9hO4SpyvrDIfELozPpiB_WtzQV9KhoMUP9R9gVohoU="
                      class="w-6 h-6 rounded-full"
                      alt=""
                    />
                    <div id="recipientContainer">
                      <h5 class="m-0 text-xs font-bold recipientName">
                        {{ recipient.name }}
                      </h5>
                      <h4
                        class="m-0 text-xs font-thin text-slate-500 recipientEmail"
                      >
                        {{ recipient.email }}
                      </h4>
                    </div>
                  </div>
                </div>
                <div
                  @click="openNewRecipientModal"
                  class="px-2 flex py-0.5 items-center space-x-1.5 cursor-pointer hover:bg-gray-100"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 rounded-full text-center text-green-500 bg-green-100 p-1"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                    />
                  </svg>

                  <div>
                    <h5 class="m-0 text-xs font-bold text-green-500">
                      Add recipient
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- edit -->

          <div
            v-for="(sign, index) of documents.documents.signatures"
            :key="index"
          >
            <div
              class="absolute signatureedit select-none userSign"
              id="recipientName"
              :recipientEmail="sign.email"
            >
              <div
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g
                    fill="none"
                    fill-rule="evenodd"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    transform="translate(3 3)"
                  >
                    <path
                      d="m14 1c.8284271.82842712.8284271 2.17157288 0 3l-9.5 9.5-4 1 1-3.9436508 9.5038371-9.55252193c.7829896-.78700064 2.0312313-.82943964 2.864366-.12506788z"
                    />
                    <path d="m6.5 14.5h8" />
                    <path d="m12.5 3.5 1 1" />
                  </g>
                </svg>
                <span>Signature</span>
              </div>
              <div
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="sign.id"
                  :user_id="sign.user_id"
                />
              </div>
              <div class="w-full user hidden items-center m2-3 justify-center">
                <h1
                  class="text-blue-500 m-0 w-auto px-3 shadow-lg bg-white rounded-xl text-sm"
                >
                  {{ sign.name }}
                </h1>
              </div>
            </div>
          </div>

          <div
            v-for="(sign, index) of documents.documents.initials"
            :key="index"
          >
            <div
              class="absolute initialedit select-none userSign"
              id="recipientName"
              :recipientEmail="sign.email"
            >
              <div
                :class="[sign.result ? 'hidden' : 'flex']"
                class="border signImg items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-[#19C2B9] bg-transparent border-[#19C2B9]"
              >
                <svg
                  height="21"
                  viewBox="0 0 21 21"
                  width="21"
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g
                    fill="none"
                    fill-rule="evenodd"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    transform="translate(3 3)"
                  >
                    <path
                      d="m14 1c.8284271.82842712.8284271 2.17157288 0 3l-9.5 9.5-4 1 1-3.9436508 9.5038371-9.55252193c.7829896-.78700064 2.0312313-.82943964 2.864366-.12506788z"
                    />
                    <path d="m6.5 14.5h8" />
                    <path d="m12.5 3.5 1 1" />
                  </g>
                </svg>
                <span>Initial</span>
              </div>
              <div
                :class="[sign.result ? 'flex' : 'hidden']"
                class="border imgSign items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-blue-400 bg-transparent border-blue-400"
              >
                <img
                  :src="[sign.result ?? signatureResult]"
                  alt=""
                  class="h-14 w-24 img"
                  :id="sign.id"
                  :user_id="sign.user_id"
                />
              </div>
              <div class="w-full user hidden items-center m2-3 justify-center">
                <h1
                  class="text-blue-500 m-0 w-auto px-3 shadow-lg bg-white rounded-xl text-sm"
                >
                  {{ sign.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(text, index) of documents.documents.texts" :key="index">
            <div
              id="recipientName"
              :recipientEmail="text.email"
              class="absolute w-[140px] textedit select-none userSign"
            >
              <div
                @click="changeWriteStatus"
                :class="[text.result ? 'hidden' : 'flex']"
                class="border signText items-center justify-center gap-2 cursor-pointer p-2 m-0 font-thin text-sm text-yellow-600 bg-transparent border-yellow-600"
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
              <div
                :class="[text.result ? 'flex' : 'hidden']"
                class="border-yellow-500 p-1 overflow-hidden border textField justify-center items-center"
              >
                <h1 class="w-full m-0 text-yellow-500 break-words">
                  {{ text.result }}
                </h1>
              </div>

              <div class="w-full user hidden items-center mt-2 justify-center">
                <h1
                  class="text-yellow-500 m-0 w-auto px-3 shadow-lg bg-white rounded-xl text-sm"
                >
                  {{ text.name }}
                </h1>
              </div>
            </div>
          </div>

          <div v-for="(date, index) of documents.documents.dates" :key="index">
            <div
              id="recipientName"
              :recipientEmail="date.email"
              class="absolute dateedit select-none userSign"
            >
              <div>
                <div
                  :class="[date.result ? 'hidden' : 'flex']"
                  class="signDate"
                >
                  <input
                    @change="saveDate"
                    :user_id="date.nonuser_id"
                    type="date"
                    disabled
                    class="border-pink-600 text-sm text-pink-600 bg-transparent"
                  />
                </div>
                <div
                  :class="[date.result ? 'flex' : 'hidden']"
                  class="border-pink-500 p-1.5 border dateSign justify-center items-center"
                >
                  <h1 class="m-0 text-pink-500">{{ date.result }}</h1>
                </div>
              </div>
              <div class="w-full user hidden items-center 2t-3 justify-center">
                <h1
                  class="text-red-500 m-0 w-auto px-3 shadow-lg bg-white rounded-xl text-sm"
                >
                  {{ date.name }}
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ToolBar>
        <template #tools>
          <Tools
            @increaseText="increaseText"
            @increaseSignature="increaseSignature"
            @increaseDate="increaseDate"
            @increaseInitial="increaseInitial"
            :recipientName="recipientName"
          />
        </template>
        <template #fillabes>
          <Fillabes
            :documents="documents.documents"
            @choosed-recipient="choosedRecipient"
            @openNewRecipientModal="openNewRecipientModal"
          />
        </template>
        <template #connectinitail>
          <ConnectInitial
            :recipients="documents.documents.recipients"
            @signConnection="signConnection"
          />
        </template>
      </ToolBar>
    </div>
  </div>
</template>
  <script setup>
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { Link, router, Head, useForm } from "@inertiajs/vue3";
import { onMounted, onUpdated, reactive, ref } from "vue";
import { initFlowbite, Modal } from "flowbite";
import MailModal from "@/Components/Modals/MailModal.vue";
import NewRecipientModal from "@/Components/Modals/RecipientModal.vue";
import SignatureModal from "@/Components/Modals/SignatureModal.vue";
import NewDocumentName from "@/Components/Modals/NewDocumentName.vue";
import NewDocumentUpload from "@/Components/Modals/NewDocumentModal.vue";
import EditAside from "@/Components/Layouts/EditAside.vue";
import Tools from "@/Components/Documents/Tools.vue";
import ToolBar from "@/Components/Documents/ToolBar.vue";
import Fillabes from "@/Components/Documents/Fillabes.vue";
import ConnectInitial from "@/Components/Documents/ConnectInitial.vue";
import moment from "moment";
import axios from "axios";

const documents = defineProps({
  documents: Object,
  auth: Object,
});
const signConnects = ref(null);
const signConnection = (data) => {
  signConnects.value = data;
};
const initialAssignRecipent = (e) => {
  let recipientStatus = e.target
    .closest(".initial")
    .querySelector("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
};

const assignRecipent = (e) => {
  let recipientStatus = e.target
    .closest(".signature")
    .querySelector("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
};

const textAssignRecipent = (e) => {
  let recipientStatus = e.target.closest(".text").querySelector("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
};

const changeWriteStatus = (e) => {
  const main = e.target.closest(".fields");
  if (main.querySelector(".signText").classList.contains("flex")) {
    main.querySelector(".signText").classList.remove("flex");
    main.querySelector(".signText").classList.add("hidden");
    main.querySelector(".textInput").classList.remove("hidden");
    main.querySelector(".textInput").classList.add("flex");
  }
};

const dateAssignRecipent = (e) => {
  let recipientStatus = e.target.closest(".date").querySelector("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
};
const form = reactive({
  newDocumentName: null,
});
const recipientName = ref("Assign");
const recipientEmail = ref("unknown");
const nameStatus = ref(true);
const choosedRecipient = ({ name, email }) => {
  recipientName.value = name;
  recipientEmail.value = email;
};

const chooseRecipients = (e) => {
  let main = e.target.closest(".fields");
  let recipient = e.target
    .closest(".signature")
    .querySelector("#recipientName");
  recipient.innerText = e.target
    .closest("#recipientContainer")
    .querySelector(".recipientName").innerText;
  recipient.setAttribute(
    "recipientEmail",
    e.target.closest("#recipientContainer").querySelector(".recipientEmail")
      .innerText
  );
  let recipientStatus = e.target.closest("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
  nameStatus.value = false;
};
const chooseInitialRecipients = (e) => {
  let main = e.target.closest(".fields");
  let recipient = e.target.closest(".initial").querySelector("#recipientName");
  recipient.innerText = e.target
    .closest("#recipientContainer")
    .querySelector(".recipientName").innerText;
  recipient.setAttribute(
    "recipientEmail",
    e.target.closest("#recipientContainer").querySelector(".recipientEmail")
      .innerText
  );
  let recipientStatus = e.target.closest("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
  nameStatus.value = false;
};
const chooseTextRecipients = (e) => {
  let main = e.target.closest(".fields");
  let recipient = e.target.closest(".text").querySelector("#recipientName");
  recipient.innerText = e.target
    .closest("#recipientContainer")
    .querySelector(".recipientName").innerText;
  recipient.setAttribute(
    "recipientEmail",
    e.target.closest("#recipientContainer").querySelector(".recipientEmail")
      .innerText
  );
  let recipientStatus = e.target.closest("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
  nameStatus.value = false;
};

const chooseDateRecipients = (e) => {
  let main = e.target.closest(".fields");
  let recipient = e.target.closest(".date").querySelector("#recipientName");
  recipient.innerText = e.target
    .closest("#recipientContainer")
    .querySelector(".recipientName").innerText;
  recipient.setAttribute(
    "recipientEmail",
    e.target.closest("#recipientContainer").querySelector(".recipientEmail")
      .innerText
  );
  let recipientStatus = e.target.closest("#recipients");
  if (recipientStatus.classList.contains("hidden")) {
    recipientStatus.classList.remove("hidden");
  } else {
    recipientStatus.classList.add("hidden");
  }
  recipientStatus.classList.add("block");
  nameStatus.value = false;
};

const sendMailForm = reactive({
  sendMail: null,
});
const mails = reactive(["list", "of", "options"]);
const toggle = ref(false);
const uploadedDocument = ref("");
const signatures = ref([]);
const texts = ref([]);
const dates = ref([]);
const initials = ref([]);
const WriteStatus = ref(true);
const signatureEdit = ref(null);
const initialEdit = ref(null);
const TextEdit = ref(null);
const editDate = ref(null);
const signatureEditStatus = ref(false);
const initialEditStatus = ref(false);
const TextEditStatus = ref(false);
const DateEditStatus = ref(false);
const dragText = ref("");
const date = ref("");
const documentNameModal = ref(null);
const sendModal = ref(null);
const recipientEmails = ref([]);
const signatureModal = ref(null);
const signatureResult = ref(null);
const newDocumentUpload = ref(null);
const newRecipientModal = ref(null);

const openEmailModal = () => {
  documentNameModal.value.show();
  let recipientEmail = document.querySelectorAll("#recipientName");
  recipientEmail.forEach((email) => {
    if (recipientEmails.value.includes(email.getAttribute("recipientemail"))) {
      return;
    }
    if (email.getAttribute("recipientemail") != "unknown") {
      return recipientEmails.value.push(email.getAttribute("recipientemail"));
    }
  });
};

const docs = (doc) => {
  return location.origin + "/storage/documents/" + doc;
};

const openNewDocumentUpload = () => {
  newDocumentUpload.value.show();
};

const closeNewDocumentUpload = (data) => {
  if (data) {
    documents.documents.doc_docs = data.doc_docs;
  }
  newDocumentUpload.value.hide();
};

const closeNewRecipientModal = (data) => {
  documents.documents.recipients = data;
  newRecipientModal.value.hide();
};

const closeSignatureModal = () => {
  signatureModal.value.hide();
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

const deleteDocument = (doc) => {
  const form = useForm({
    id: documents.documents.id,
    doc: doc,
    _method: "DELETE",
  });
  form.post(route("documents.delete.document", form.id));
};
const saveDocumentName = () => {
  axios
    .put(route("document.new.document-name", documents.documents.id), form)
    .then(({ data }) => {
      documents.documents.doc_name = data.document.doc_name;
      documentNameModal.value.hide();
      openSendMailModal();
    });
};
const toggleAside = () => {
  toggle.value = !toggle.value;
};
const closeToggle = () => {
  toggle.value = !toggle.value;
};
const openNewRecipientModal = () => {
  newRecipientModal.value.show();
};
const openSignatureModal = () => {
  signatureModal.value.show();
};

const editSignature = (e) => {
  signatureEdit.value = e.target.getAttribute("count");
  signatureEditStatus.value = true;
};
const editInitial = (e) => {
  initialEdit.value = e.target.getAttribute("count");
  initialEditStatus.value = true;
};
const editText = (e) => {
  TextEdit.value = e.target.getAttribute("count");
  TextEditStatus.value = true;
};

const dateEdit = (e) => {
  editDate.value = e.target.getAttribute("count");
  DateEditStatus.value = true;
};

const increaseSignature = () => {
  signatures.value.push(signatures.value.length);
  dragText.value = "signature";
};

const increaseDate = () => {
  dates.value.push(dates.value.length);
  dragText.value = "date";
};

const increaseInitial = () => {
  initials.value.push(initials.value.length);
  dragText.value = "initial";
};
moment(documents.documents.updated_at).format("ll");

const increaseText = () => {
  texts.value.push(texts.value.length);
  dragText.value = "text";
};

const deleteField = (e) => {
  const name = e.target.closest(".fields").getAttribute("name");
  const target = e.target.closest(`.${name}`);
  target.classList.add("hidden");
  target.style.top = `0px`;
  target.style.left = `0px`;
};
onUpdated(() => {
  const newDocumentUploadModal = document.querySelector(
    "#newDocumentUploadModal"
  );
  newDocumentUpload.value = new Modal(newDocumentUploadModal);

  const images = document.querySelectorAll("#image");

  images.forEach((image, index) => {
    image.addEventListener("drop", (e) => {
      e.preventDefault();
      let mainTag = e.target.closest("#main");

      const documentSignatureFieldsContainer =
        document.querySelectorAll(".signature");

      const documentTextFieldsContainer = document.querySelectorAll(".text");
      const documentDateFieldsContainer = document.querySelectorAll(".date");

      const documentSignatureField =
        documentSignatureFieldsContainer[signatures.value.length - 1];

      const documentTextField =
        documentTextFieldsContainer[texts.value.length - 1];

      const documentDateField =
        documentDateFieldsContainer[dates.value.length - 1];

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
          documentSignatureField.style.top = `${e.offsetY - 40}px`;
          documentSignatureField.style.left = `${e.offsetX - 40}px`;
          documentSignatureField.setAttribute("x", e.offsetX - 40);
          documentSignatureField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentSignatureField);
        }
      } else if (
        signatureEditStatus.value &&
        !TextEditStatus.value &&
        !DateEditStatus.value
      ) {
        const editSignatureField =
          documentSignatureFieldsContainer[signatureEdit.value];
        if (
          editSignatureField &&
          editSignatureField.getAttribute("count") == signatureEdit.value
        ) {
          editSignatureField.style.top = `${e.offsetY - 40}px`;
          editSignatureField.style.left = `${e.offsetX - 40}px`;
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
          console.log(mainTag);
          documentTextField.classList.remove("hidden");
          documentTextField.style.top = `${e.offsetY - 40}px`;
          documentTextField.style.left = `${e.offsetX - 40}px`;
          documentTextField.setAttribute("x", e.offsetX - 40);
          documentTextField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentTextField);
        }
      } else if (
        TextEditStatus.value &&
        !signatureEditStatus.value &&
        !DateEditStatus.value
      ) {
        const editTextField = documentTextFieldsContainer[TextEdit.value];
        if (
          editTextField &&
          editTextField.getAttribute("count") == TextEdit.value
        ) {
          editTextField.style.top = `${e.offsetY - 40}px`;
          editTextField.style.left = `${e.offsetX - 40}px`;
        }
        TextEditStatus.value = !TextEditStatus.value;
      } else if (
        !DateEditStatus.value &&
        documentDateField &&
        dragText.value == "date"
      ) {
        if (
          documentDateField.getAttribute("count") ==
          dates.value[dates.value.length - 1]
        ) {
          console.log(mainTag);
          documentDateField.classList.remove("hidden");
          documentDateField.style.top = `${e.offsetY - 40}px`;
          documentDateField.style.left = `${e.offsetX - 40}px`;
          documentDateField.setAttribute("x", e.offsetX - 40);
          documentDateField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentDateField);
        }
      } else if (
        DateEditStatus.value &&
        !signatureEditStatus.value &&
        !TextEditStatus.value
      ) {
        const editDateField = documentDateFieldsContainer[editDate.value];
        if (
          editDateField &&
          editDateField.getAttribute("count") == editDate.value
        ) {
          editDateField.style.top = `${e.offsetY - 40}px`;
          editDateField.style.left = `${e.offsetX - 40}px`;
        }
        DateEditStatus.value = !DateEditStatus.value;
      }
    });

    image.addEventListener(
      "dragover",
      (e) => {
        e.preventDefault();
      },
      false
    );
  });
  initFlowbite();
});

onMounted(() => {
  const userSigns = document.querySelectorAll(".userSign");
  userSigns.forEach((sign) => {
    let user = sign.querySelector(".user");
    sign.addEventListener("mousemove", (e) => {
      if (user.classList.contains("hidden")) {
        user.classList.remove("hidden");
        user.classList.add("flex");
      }
    });
    sign.addEventListener("mouseout", (e) => {
      if (user.classList.contains("flex")) {
        user.classList.remove("flex");
        user.classList.add("hidden");
      }
    });
  });
  const modalDocument = document.querySelector("#changeDocumentName");
  const newRecipient = document.querySelector("#newRecipient");
  const modalMail = document.querySelector("#sendMailModal");
  const newDocumentUploadModal = document.querySelector(
    "#newDocumentUploadModal"
  );
  const modalSignature = document.querySelector("#signature-modal");
  signatureModal.value = new Modal(modalSignature);
  newDocumentUpload.value = new Modal(newDocumentUploadModal);
  documentNameModal.value = new Modal(modalDocument);
  newRecipientModal.value = new Modal(newRecipient);
  sendModal.value = new Modal(modalMail);
  date.value = `Updated ${moment(documents.documents.updated_at).format("ll")}`;
  uploadedDocument.value =
    location.origin + "/storage/documents/" + documents.documents.doc_docs;
  form.newDocumentName = documents.documents.doc_name;

  const images = document.querySelectorAll("#image");

  images.forEach((image, index) => {
    image.addEventListener("drop", (e) => {
      e.preventDefault();
      let mainTag = e.target.closest("#main");

      const documentSignatureFieldsContainer =
        document.querySelectorAll(".signature");

      const documentTextFieldsContainer = document.querySelectorAll(".text");
      const documentDateFieldsContainer = document.querySelectorAll(".date");
      const documentInitialFieldsContainer =
        document.querySelectorAll(".initial");

      const documentSignatureField =
        documentSignatureFieldsContainer[signatures.value.length - 1];

      const documentTextField =
        documentTextFieldsContainer[texts.value.length - 1];

      const documentDateField =
        documentDateFieldsContainer[dates.value.length - 1];

      const documentInitialField =
        documentInitialFieldsContainer[initials.value.length - 1];

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
          documentSignatureField.style.top = `${e.offsetY - 40}px`;
          documentSignatureField.style.left = `${e.offsetX - 40}px`;
          documentSignatureField.setAttribute("x", e.offsetX - 40);
          documentSignatureField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentSignatureField);
        }
      } else if (
        signatureEditStatus.value &&
        !TextEditStatus.value &&
        !DateEditStatus.value &&
        !initialEditStatus.value
      ) {
        const editSignatureField =
          documentSignatureFieldsContainer[signatureEdit.value];
        if (
          editSignatureField &&
          editSignatureField.getAttribute("count") == signatureEdit.value
        ) {
          editSignatureField.style.top = `${e.offsetY - 40}px`;
          editSignatureField.style.left = `${e.offsetX - 40}px`;
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
          documentTextField.style.top = `${e.offsetY - 40}px`;
          documentTextField.style.left = `${e.offsetX - 40}px`;
          documentTextField.setAttribute("x", e.offsetX - 40);
          documentTextField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentTextField);
        }
      } else if (
        TextEditStatus.value &&
        !signatureEditStatus.value &&
        !DateEditStatus.value &&
        !initialEditStatus.value
      ) {
        const editTextField = documentTextFieldsContainer[TextEdit.value];
        if (
          editTextField &&
          editTextField.getAttribute("count") == TextEdit.value
        ) {
          editTextField.style.top = `${e.offsetY - 40}px`;
          editTextField.style.left = `${e.offsetX - 40}px`;
        }
        TextEditStatus.value = !TextEditStatus.value;
      } else if (
        !DateEditStatus.value &&
        documentDateField &&
        dragText.value == "date"
      ) {
        if (
          documentDateField.getAttribute("count") ==
          dates.value[dates.value.length - 1]
        ) {
          documentDateField.classList.remove("hidden");
          documentDateField.style.top = `${e.offsetY - 40}px`;
          documentDateField.style.left = `${e.offsetX - 40}px`;
          documentDateField.setAttribute("x", e.offsetX - 40);
          documentDateField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentDateField);
        }
      } else if (
        DateEditStatus.value &&
        !signatureEditStatus.value &&
        !TextEditStatus.value &&
        !initialEditStatus.value
      ) {
        const editDateField = documentDateFieldsContainer[editDate.value];
        if (
          editDateField &&
          editDateField.getAttribute("count") == editDate.value
        ) {
          editDateField.style.top = `${e.offsetY - 40}px`;
          editDateField.style.left = `${e.offsetX - 40}px`;
        }
        DateEditStatus.value = !DateEditStatus.value;
      } else if (
        !initialEditStatus.value &&
        documentInitialField &&
        dragText.value == "initial"
      ) {
        if (
          documentInitialField.getAttribute("count") ==
          initials.value[initials.value.length - 1]
        ) {
          documentInitialField.classList.remove("hidden");
          documentInitialField.style.top = `${e.offsetY - 40}px`;
          documentInitialField.style.left = `${e.offsetX - 40}px`;
          documentInitialField.setAttribute("x", e.offsetX - 40);
          documentInitialField.setAttribute("y", e.offsetY - 40);
          mainTag.append(documentInitialField);
        }
      } else if (
        initialEditStatus.value &&
        !signatureEditStatus.value &&
        !TextEditStatus.value &&
        !DateEditStatus.value
      ) {
        const editInitialField =
          documentInitialFieldsContainer[initialEdit.value];
        if (
          editInitialField &&
          editInitialField.getAttribute("count") == initialEdit.value
        ) {
          editInitialField.style.top = `${e.offsetY - 40}px`;
          editInitialField.style.left = `${e.offsetX - 40}px`;
        }
        initialEditStatus.value = !initialEditStatus.value;
      }
    });

    image.addEventListener(
      "dragover",
      (e) => {
        e.preventDefault();
      },
      false
    );
  });

  const mainTag = document.querySelectorAll("#main");
  const signatureedit = document.querySelectorAll(".signatureedit");
  const initialedit = document.querySelectorAll(".initialedit");
  const dateedit = document.querySelectorAll(".dateedit");
  const textedit = document.querySelectorAll(".textedit");
  signatureedit?.forEach((signature, index) => {
    signature.style.top = documents.documents.signatures[index]?.y;
    signature.style.left = documents.documents.signatures[index]?.x;
    signatureResult.value = documents.documents.signatures[index]?.result;
    mainTag[documents.documents.signatures[index].index].append(signature);
  });

  initialedit?.forEach((signature, index) => {
    signature.style.top = documents.documents.initials[index]?.y;
    signature.style.left = documents.documents.initials[index]?.x;
    signatureResult.value = documents.documents.initials[index]?.result;
    mainTag[documents.documents.initials[index].index].append(signature);
  });

  dateedit?.forEach((date, index) => {
    date.style.top = documents.documents.dates[index]?.y;
    date.style.left = documents.documents.dates[index]?.x;
    signatureResult.value = documents.documents.dates[index]?.result;
    mainTag[documents.documents.dates[index].index].append(date);
  });

  textedit.forEach((text, index) => {
    text.style.top = documents.documents.texts[index].y;
    text.style.left = documents.documents.texts[index].x;
    signatureResult.value = documents.documents.texts[index].result;
    mainTag[documents.documents.texts[index].index].append(text);
  });

  initFlowbite();
});

const acceptSignature = (data) => {
  signatureResult.value = data;
  signatureModal.value.hide();
};
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
