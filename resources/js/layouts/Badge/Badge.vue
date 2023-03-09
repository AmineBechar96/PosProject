<template>
<span :class="'bg-'+ color + '-100 text-' + color + '-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-'+ color + '-900 dark:text-'+ color + '-300'">{{title}}</span>
</template>

<script setup>

const props = defineProps({
  title: String,
  color: String,
});
</script>