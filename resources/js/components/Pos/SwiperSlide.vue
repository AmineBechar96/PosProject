<template>
    <swiper-slide
      class="card swiper-slide w-24 shrink-0 cursor-pointer"
      :key="data.key"
    >
      <div class="flex flex-col items-center rounded-lg px-2 py-4 mr-3">
        <img class="w-12" :src="data.src" alt="image" />
        <h3 class="pt-2 font-medium tracking-wide line-clamp-1">{{ data.name }}</h3>
      </div>
    </swiper-slide>
</template>

<script setup>
import {SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/scrollbar";
import "swiper/css/navigation";
import "swiper/css/pagination";

const props = defineProps({
  data: Object,
});
</script>
<style scoped>
@import "/public/css/app.css";
</style>