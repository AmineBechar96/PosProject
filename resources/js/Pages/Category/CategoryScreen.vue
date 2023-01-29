<template>
    <div class="bg-gray-100 w-full h-full">
        <TheNavbar />
        <BreadcumberComponent class="mt-6 ml-20"></BreadcumberComponent>
        <div
            class="mx-auto mt-12 w-3/4 bg-white border border-gray-200 rounded-3xl shadow-lg sm:p-6 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between pb-2 mb-2">
                    <DropdownComponent></DropdownComponent>
                    <SearchInput></SearchInput>
                </div>
                <TableComponent class="mt-4"></TableComponent>
                <nav class="flex items-center justify-between pt-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                            class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span
                            class="font-semibold text-gray-900 dark:text-white">1000</span></span>
                    <Pagination class="mt-12 ml-50 border 1x border-red" :links="categories.links" />
                </nav>  
                <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800"><font-awesome-icon icon="fa-solid fa-add" class="mr-1"/>Add Category</button>
        </div>
    </div>
    
</template>

<script setup>
import BreadcumberComponent from '../../components/BreadcumberComponent.vue'
import DropdownComponent from '../../components/DropdownComponent.vue'
import SearchInput from '../../components/SearchInput.vue'
import TableComponent from '../../components/TableComponent.vue'
import Pagination from '../../components/Pagination.vue'

const props = defineProps({
    categories: Object,
})
</script>