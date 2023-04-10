<template>
  <div class="flex items-center justify-between">
    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
      Categories
    </p>
    <div class="flex">
      <button
        :disabled="empty"
        class="btn prev-btn h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-50 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        @click="slideBefore()"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.5"
            d="M15 19l-7-7 7-7"
          />
        </svg>
      </button>
      <button
        :disabled="full"
        class="btn next-btn h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        @click="slideTo()"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.5"
            d="M9 5l7 7-7 7"
          />
        </svg>
      </button>
    </div>
  </div>
  <swiper
    class="mt-5"
    :slidesPerView="6"
    :spaceBetween="25"
    :keyboard="{
      enabled: true,
    }"
    :breakpoints="{
      '0': {
        slidesPerView: 2,
        slidesPerGroup: 2,
      },
      '769': {
        slidesPerView: 3,
        slidesPerGroup: 3,
      },
      '992': {
        slidesPerView: 4,
        slidesPerGroup: 4,
      },
      '1267': {
        slidesPerView: 6,
        slidesPerGroup: 6,
      },
    }"
    :pagination="{
      type: 'fraction',
    }"
    :loop="true"
    :centeredSlides="false"
    :slidesPerGroupSkip="1"
    :grabCursor="true"
    @swiper="setSwiperRef"
  >
=
    <swiper-slide
      v-for="category in data"
      :key="category.id"
      class="card swiper-slide w-24 shrink-0 cursor-pointer"
    >
      <div class="flex flex-col items-center rounded-lg px-2 py-4 mr-3">
        <img class="w-12" src="/pos/images/100x100.png" alt="image" />
        <h3 class="pt-2 font-medium tracking-wide line-clamp-1">
          {{ category.name }}
        </h3>
      </div>
    </swiper-slide>
  </swiper>
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { ref } from "vue";
// Import Swiper styles
import "swiper/css";

import "swiper/css/scrollbar";
import "swiper/css/navigation";
import "swiper/css/pagination";

import { Keyboard, Scrollbar, Navigation, Pagination } from "swiper";

let swiperRef = null;

const empty = ref(true);
const full = ref(false);
const i = ref(0);

const props = defineProps({
  data: Object,
});

const setSwiperRef = (swiper) => {
  swiperRef = swiper;
};

const slideBefore = () => {
  full.value = false;
  console.log(swiperRef.activeIndex)
  swiperRef.slideTo(swiperRef.activeIndex - 1, 0);
  if (swiperRef.activeIndex - 1 == 0) 
  empty.value = true;
};
const slideTo = () => {
    console.log(swiperRef.activeIndex)
  empty.value = false;
  swiperRef.slideTo(swiperRef.activeIndex + 1, 0);
  if (swiperRef.activeIndex + 1 == props.data.length) 
  full.value = true;
};
</script>

<style scoped>
@import "/public/css/app.css";
</style>