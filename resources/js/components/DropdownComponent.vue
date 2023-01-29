<template>
    <div class="dropdown relative">
        <button
            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
            type="button">
            <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ per_pages ? per_pages : 5 }} Par Pages
            <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <ul class="dropdown-menu absolute hidden bg-white border border-gray-300 opacity-90 z-10 p-3 space-y-1 w-28 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownRadioButton">
            <li>
                <button @click="per_pages = 5"
                    class="flex items-center w-24 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    5
                </button>
            </li>
            <li>
                <button @click="per_pages = 10"
                    class="flex items-center w-24 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    10
                </button>
            </li>
            <li>
                <button @click="per_pages = 25"
                    class="flex items-center w-24 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    25
                </button>
            </li>
            <li>
                <button @click="per_pages = 100"
                    class="flex items-center w-24 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    100
                </button>
            </li>

        </ul>
    </div>
</template>
<style>
.dropdown:hover .dropdown-menu {
    display: block;
}
</style>
<script setup>

import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
const props = defineProps({
    filters: Object,
    routes: String
})

const per_pages = ref(props.filters.per_pages);
watch(per_pages, value => {
    router.get('/' + props.routes, { per_pages: value }, {
        preserveState: true,
        replace: true,
    });
});

</script>