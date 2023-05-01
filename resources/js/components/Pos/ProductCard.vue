<template>
  <div class="card p-2 cursor-pointer">
    <img class="rounded-lg" :src="product.photo ? 'images/800x600.png' :product.photo" alt="image" />
    <div class="pt-2">
      <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
        {{product.name}}
      </p>
      <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
        {{product.description}}
      </p>
      <p class="text-right font-medium text-primary dark:text-accent-light">
        {{product.price + ' DA'}}
      </p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  product: Object,
});
</script>

<style scoped>
@import "/public/css/app.css";
</style>