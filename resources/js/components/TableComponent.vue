<template>
    <table class="w-full mt-8 w-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" @click="sort('name')">
                    Category
                </th>
                <th scope="col" class="px-6 py-3" @click="sort('created_at')">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                <th scope="col" class="px-6 py-3" @click="sort('display')">
                    Visibility
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data.data" :key="item.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-md text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.name }}
                </th>
                <td class="px-6 py-4">
                    {{ item.created_at }}
                </td>
                <td class="px-6 py-4">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" @click="delete_item(item.id)"
                            class="group relative inline-block px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            <font-awesome-icon icon="fa-solid fa-trash" class="mr-1" />
                            <TheTooltip text="Delete"></TheTooltip>
                        </button>
                        <button type="button" @click="emit('edit_item', item)"
                            class="group relative inline-block px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            <font-awesome-icon icon="fa-solid fa-pen-to-square" class="mr-1" />
                            <TheTooltip text="Edit"></TheTooltip>
                        </button>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox"
                            :checked="item.display == '1' ? true : false" @click="emit('checkbox', item.id)"
                            class="ml-5 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <Teleport to="body">
        <AlertModal v-if="activeAlertModal" :id="item_id" @close="closeModal()" @confirm="confirm_delete_item">
        </AlertModal>
    </Teleport>
</template>
<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AlertModal from '../layouts/Modals/AlertModal.vue'

const props = defineProps({
    data: Object,
    routes: String
})

const activeAlertModal = ref(false);


const item_id = ref(0);
const column = ref("id");
const direction = ref("asc");

function sort(column_1) {
    if (direction.value == "asc") {
        direction.value = "desc";
    }
    else
        direction.value = "asc";
    column.value = column_1
    emit("filter", { column: column.value, direction: direction.value })
}
function delete_item(id) {
    item_id.value = id;
    activeAlertModal.value = true;
}

function confirm_delete_item({ decision, id }) {
    activeAlertModal.value = false;
    if (decision == true) {
        router.delete("/" + props.routes + "/" + id, {
            preserveState: true,
            replace: true,
        });
    }
}

const emit = defineEmits(['checkbox', 'edit_item', 'filter'])
</script>