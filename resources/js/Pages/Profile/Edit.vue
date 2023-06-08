<template>
  <AuthLayout title="Profile">
    <div class="min-h-screen container gap-3 flex justify-between">
      <div class="w-[35%] flex px-3 flex-col items-center">
        <div
          class="flex w-full justify-center gap-x-2 mt-3 cursor-pointer p-5 mb-3 shadow rounded bg-white"
        >
          <div class="flex flex-col gap-5">
            <div class="relative avatar duration-300 transition-opacity">
              <img
                class="object-cover w-32 h-32 rounded-full self-end"
                :src="[
                  auth.user.avatar
                    ? `/storage/${auth.user.avatar}`
                    : 'https://i.pinimg.com/564x/ff/5f/78/ff5f78476f0edf5b1bf7840f84342ebd.jpg',
                ]"
                alt=""
              />
              <input
                type="file"
                @change="uploadAvatar"
                ref="file"
                class="hidden"
              />
              <svg
                @click="openProfile"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="avatar-camera duration-300 transition-opacity text-gray-200 opacity-0 w-7 h-7 absolute top-[38%] left-[38%]"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                />
              </svg>
            </div>
            <div class="">
              <h1 class="text-2xl text-center font-bold">
                {{ auth.user.name }}
              </h1>
              <p class="text-lg text-center">Yangon,Myanmar</p>
            </div>
          </div>
        </div>

        <div class="sm:mb-3 w-full border-gray-200 h-80 sm:h-96">
          <ul
            class="flex gap-3 flex-col w-full justify-center sm:justify-start -mb-px text-sm font-medium text-center text-gray-500"
          >
            <li class="shadow" @click="information">
              <input
                class="peer sr-only inline-flex p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500 group"
                type="radio"
                value="infor-yes"
                name="information"
                id="infor-yes"
                checked
              />
              <label
                class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 focus:outline-none peer-checked:border-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all rounded hover:bg-gray-200 duration-500 ease-in-out"
                for="infor-yes"
              >
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
                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"
                  />
                </svg>

                Information
              </label>
            </li>

            <li class="shadow" @click="password">
              <input
                class="peer sr-only inline-flex p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500 group"
                type="radio"
                value="infor-yesno"
                name="information"
                id="infor-yesno"
              />
              <label
                class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 focus:outline-none peer-checked:border-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all rounded hover:bg-gray-200 duration-500 ease-in-out"
                for="infor-yesno"
              >
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
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                  />
                </svg>

                Change Password
              </label>
            </li>
            <li class="shadow" @click="signature">
              <input
                class="peer sr-only inline-flex p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500 group"
                type="radio"
                value="infor-no"
                name="information"
                id="infor-no"
              />
              <label
                class="flex justify-center cursor-pointer outline-none focus:border-transparent peer-focus:border-green-500 bg-white py-2 px-4 focus:outline-none peer-checked:border-2 peer-checked:border-green-500 peer-checked:ring-indigo-500 transition-all rounded hover:bg-gray-200 duration-500 ease-in-out"
                for="infor-no"
              >
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
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                  />
                </svg>

                Signature
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="w-full">
        <transition>
          <keep-alive>
            <component :is="selectedComponent" :auth="auth"></component>
          </keep-alive>
        </transition>
      </div>
    </div>
  </AuthLayout>
</template>
<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Information from "@/Components/Profile/Information.vue";
import Changepassword from "@/Components/Profile/Changepassword.vue";
import Signature from "@/Components/Profile/Signature.vue";
import { ref } from "vue";
defineProps({
  auth: Object,
});
const file = ref(null);
const openProfile = () => {
  file.value.click();
};
const selectedComponent = ref(Information);
const information = () => {
  selectedComponent.value = Information;
};

const signature = () => {
  selectedComponent.value = Signature;
};
const password = () => {
  selectedComponent.value = Changepassword;
};
const uploadAvatar = (e) => {
  console.log(e.target.files[0]);
  const form = useForm({
    avatar: e.target.files[0],
    _method: "PUT",
  });
  form.post(route("profile.avatar"));
};
</script>
<style  scoped>
.avatar:hover img {
  opacity: 0.7;
}
.avatar:hover .avatar-camera {
  opacity: 1;
}
</style>
