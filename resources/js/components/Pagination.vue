<template>
    <div class="flex flex-col items-center">
        <div class="inline-flex xs:mt-0" v-if="links.length > 1">
            <Link :href="links[0].url" class="inline-flex items-center px-4 py-2 text-sm font-medium text-black bg-gray-200
                rounded-l hover:bg-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400
                dark:hover:bg-gray-700 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            Prev
            </Link>
            <Link :href="links[links.length - 1].url"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-black bg-gray-200
                rounded-l hover:bg-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400
                dark:hover:bg-gray-700 dark:hover:text-white">
            Next
            <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            </Link>
        </div>
    </div>
</template>

  
<script setup>
import { Link } from '@inertiajs/vue3'

const affiche = 0;
const props = defineProps({
    links: Array,
})
</script>