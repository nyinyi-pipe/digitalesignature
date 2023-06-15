<template>
  <label class="relative inline-flex items-center cursor-pointer">
    <input
      type="checkbox"
      value=""
      @change="changeStatus(user.id)"
      class="sr-only peer"
      :checked="user.status && true"
    />
    <div
      class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full focus:ring-green-500 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"
    ></div>
  </label>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

defineProps({
  user: Object,
});

const changeStatus = (id) => {
  router.put(
    route("user.status"),
    { id },
    {
      onSuccess: () => {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        Toast.fire({
          icon: "success",
          title: "Status updated",
        });
      },
    }
  );
};
</script>
