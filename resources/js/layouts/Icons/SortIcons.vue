<template>
    <font-awesome-icon v-if="(column == column_selected && direction == 'asc')" icon="fa-solid fa-arrow-up-short-wide" />
    <font-awesome-icon v-else-if="(column == column_selected && direction == 'desc')" icon="fa-solid fa-arrow-down-short-wide" />
    <font-awesome-icon v-else icon="fa-solid fa-sort" />
</template>

<script setup>
const props = defineProps({
    column: String,
    column_selected: String,
    direction: String,
})
</script>