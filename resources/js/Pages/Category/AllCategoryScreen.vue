<template>
    <Base>
    <div>
        <div class="bg-gray-100 w-screen">
            <TheNavbar />
            <BreadcumberComponent class="mt-6 ml-20" :menu="['Category', menu]"></BreadcumberComponent>
            <div
                class="mx-auto mt-12 w-3/4 bg-white border border-gray-200 rounded-3xl shadow-lg p-6 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                <div class="sm:flex sm:items-center sm:justify-between pb-2 mb-2">
                    <DropdownComponent :filters="filters" routes="categories" @filter="filter"></DropdownComponent>
                    <SearchInput :filters="filters" routes="categories" @filter="filter"></SearchInput>
                </div>
                <div class="flex items-center">
                    <TableComponent :routes="page_name" :data="categories" @checkbox="checkbox" @edit_item="edit_item"
                        @filter="filter">
                    </TableComponent>
                </div>
                <nav class="sm:flex sm:items-center sm:justify-between pt-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                            class="font-semibold text-gray-900 dark:text-white">{{ categories.from }}-{{
                                categories.to
                            }}</span>
                        of <span class="font-semibold text-gray-900 dark:text-white">{{
                            categories.total
                        }}</span></span>
                    <Pagination class="mt-12 ml-50" :links="categories.links" />
                </nav>
                <div class="px-4 py-3 sm:flex  sm:px-6">
                    <button type="button" @click="activeAddModal = true"
                        class="mt-4 w-full sm:w-auto inline-flex justify-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800"><font-awesome-icon
                            icon="fa-solid fa-add" class="mr-1" />Add Category</button>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <AddModal :page_name="page_name" :open="activeAddModal" :errors="errors" @close="closeModal(1)"
                @store="store_item"></AddModal>
            <EditModal :page_name="page_name" :open="activeEditModal" :errors="errors" @close="closeModal(2)"
                @update="update_item" :items="items"></EditModal>
        </Teleport>
    </div>
    </Base>
</template>

<script setup>
import BreadcumberComponent from '../../components/BreadcumberComponent.vue'
import DropdownComponent from '../../components/DropdownComponent.vue'
import SearchInput from '../../components/SearchInput.vue'
import TableComponent from '../../components/Table/TableComponent.vue'
import Pagination from '../../components/Pagination.vue'

import AddModal from '../../layouts/Modals/Add/AddModal.vue'
import EditModal from '../../layouts/Modals/EditModal.vue'

import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
const props = defineProps({
    page_name: String,
    categories: Object,
    filters: Object,
    per_pages: Object,
    errors: Object
})

const activeAddModal = ref(false);
const activeEditModal = ref(false);
console.log()
const per_page_ref = ref(5);
const column_ref = ref("id");
const direction_ref = ref("asc");
const search_ref = ref("");

const items = ref({});
const menu = props.page_name == 'categories' ? 'Product' : 'Expence';

function closeModal(id) {
    props.errors.name = null;
    if (id == 1) {
        activeAddModal.value = false;
    }
    if (id == 2) {
        console.log(id);
        activeEditModal.value = false;
    }
}

function checkbox(id) {
    router.post("/update_display/", { checkbox: id }, {
        replace: true,
        preserveScroll: true,
        preserveState: true,
    });
}

function edit_item(item) {
    items.value = item;
    activeEditModal.value = true;
}

function update_item(items) {
    router.put(props.page_name + items['id'], { items: items }, {
        replace: true,
        preserveScroll: true,
        preserveState: true,
        onFinish: () => activeEditModal.value = false
    });
}

function filter({ column, direction, per_pages, search }) {
    if (column != null) {
        column_ref.value = column;
    }
    if (direction != null) {
        direction_ref.value = direction;
    }
    if (per_pages != null) {
        per_page_ref.value = per_pages;
    }
    if (search != null) {
        search_ref.value = search;
    }
    router.get(props.page_name, { column: column_ref.value, direction: direction_ref.value, per_pages: per_page_ref.value, search: search_ref.value }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
}
</script>