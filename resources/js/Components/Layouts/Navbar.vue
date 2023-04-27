<template>
  <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
    <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
      <h5 hidden class="text-2xl font-medium lg:block">
        {{ title }}
      </h5>
      <button
        @click="$emit('toggleAside')"
        class="w-12 h-16 -mr-2 border-r lg:hidden"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 my-auto"
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
      </button>
      <div class="flex space-x-4">
        <!--search bar -->
        <div hidden class="md:block">
          <div
            class="relative flex items-center text-gray-400 focus-within:text-green-400"
          >
            <span
              class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300"
            >
              <svg
                xmlns="http://ww50w3.org/2000/svg"
                class="w-4 fill-current"
                viewBox="0 0 35.997 36.004"
              >
                <path
                  id="Icon_awesome-search"
                  data-name="search"
                  d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"
                ></path>
              </svg>
            </span>
            <input
              type="search"
              name="leadingIcon"
              id="leadingIcon"
              placeholder="Search here"
              class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none hover:border-green-500 focus:ring-green-500 border border-gray-300 focus:border-green-300 transition"
            />
          </div>
        </div>
        <!--/search bar -->
        <button
          aria-label="search"
          class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden"
        >
          <svg
            xmlns="http://ww50w3.org/2000/svg"
            class="w-4 mx-auto fill-current text-gray-600"
            viewBox="0 0 35.997 36.004"
          >
            <path
              id="Icon_awesome-search"
              data-name="search"
              d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"
            ></path>
          </svg>
        </button>

        <div>
          <div class="flex items-center gap-x-2 cursor-pointer">
            <img
              class="object-cover w-9 h-9 rounded-full"
              data-dropdown-toggle="dropdown"
              src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
              alt=""
            />
          </div>

          <div
            id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32 dark:bg-gray-700"
          >
            <ul class="text-sm text-gray-700 dark:text-gray-200">
              <li class="block py-2 hover:bg-green-100 cursor-pointer">
                <div class="gap-3 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                  </svg>

                  <Link :href="route('profile.edit')" class="text-green-500"
                    >Profile</Link
                  >
                </div>
              </li>
              <li class="block py-2 hover:bg-green-100 cursor-pointer">
                <div class="gap-3 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 text-green-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                    />
                  </svg>

                  <p @click="logout" class="text-green-500">Logout</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  <script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { Link } from "@inertiajs/vue3";

onMounted(() => {
  initFlowbite();
});
defineProps({
  title: String,
});

const logout = () => {};
</script>
