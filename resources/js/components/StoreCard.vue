<template>
  <div class="grid my-4 gap-8 grid-cols-1 md:grid-cols-1 xl:grid-cols-1"></div>
  <div class="flex flex-col-2 w-full">
    <div class="bg-red-200 opacity-70 shadow-md rounded-3xl p-6 w-2/3 mx-auto cursor-pointer">
      <a @click="open_modal(data.id, data.status)">
        <div class="flex-none lg:flex">
          <div class="h-full w-full lg:h-screen lg:w-48 lg:mb-0 mb-3">
            <img
              :src="'/images/4058271.jpg'"
              alt="Just a flower"
              class="w-full h-full object-scale-down lg:object-cover lg:h-48 rounded-2xl"
            />
          </div>
          <div class="flex-auto ml-3 justify-evenly py-2">
            <div class="flex flex-wrap">
              <div class="w-full flex-none text-xs text-blue-700 font-medium">
                Shop
              </div>
              <h2 class="flex-auto text-lg font-medium">{{ data.name }}</h2>
            </div>
            <p class="mt-3"></p>
            <div class="flex">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
                <p class="text-xs">
                    {{ data.phone }}
                </p>
              </div>
            <div class="flex py-4 text-sm text-gray-600 justify-between">
              <div class="flex">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 mr-3"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                  ></path>
                </svg>
                <p class="">{{ data.city }}</p>
              </div>
              <div class="flex">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
                <p class="text-xs">{{ data.email }}</p>
              </div>
              
            </div>
            
            <div class="flex p-4 pb-2 border-t border-gray-700"></div>
            <div class="flex space-x-3 text-sm font-medium">
              <div class="flex-auto flex space-x-3"></div>
              <button
                class="mb-2 md:mb-0 bg-black px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-gray-800"
                type="button"
                aria-label="like"
              >
                Fermer
              </button>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <Teleport to="body">
    <StoreModal v-if="createRegisterModal"></StoreModal>
  </Teleport>
</template>

<script setup>
import { ref, reactive, toRefs } from "vue";
import { usePayementStore } from "../stores/PayementStores.js";
import StoreModal from "../layouts/Dashboard/StoreModal.vue";
import { router } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
});

const payementStore = usePayementStore();
const createRegisterModal = ref(false);

function open_modal(id, status) {
  if (status == 0) {
    createRegisterModal.value = true;
  }
  //else
  //router.get(url, data, options)
}
</script>