<template>
  <div
  class="badge rounded-full border"
    :class="{'border-error text-error dark:border-error-light dark:text-error-light':color=='secondary',
    'border-warning text-warning dark:border-warning-light dark:text-warning-light':color=='warning',
    'border-success text-success dark:border-success-light dark:text-success-light':color=='success',
  
  }"
  >
  {{ title }}
  </div>
</template>

<script setup>
const props = defineProps({
  title: String,
  color: String,
});
</script>

<style scoped>
.badge,
.tag {
  @apply inline-flex items-center justify-center px-2 py-1.5
     text-xs font-inter tracking-wide align-baseline transition-all duration-200
     leading-none rounded font-medium;
}
</style>