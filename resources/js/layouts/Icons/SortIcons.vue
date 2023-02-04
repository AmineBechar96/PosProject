<template>
    <font-awesome-icon v-if="(column == column_selected && direction == 'asc')" icon="fa-solid fa-arrow-up-short-wide" class="ml-4" />
    <font-awesome-icon v-else-if="(column == column_selected && direction == 'desc')" icon="fa-solid fa-arrow-down-short-wide" class="ml-4" />
    <font-awesome-icon v-else icon="fa-solid fa-sort" class="ml-4" />
</template>

<script setup>
const props = defineProps({
    column: String,
    column_selected: String,
    direction: String,
})
</script>