<template>
    <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" @click="sort('name')">
                        Category
                        <SortIcons :column="column" column_selected='name' :direction="direction"></SortIcons>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" @click="sort('created_at')">
                        Date
                        <SortIcons :column="column" column_selected='created_at' :direction="direction"></SortIcons>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" @click="sort('display')" v-if="routes == 'categories'">
                        Visibility
                        <SortIcons :column="column" column_selected='display' :direction="direction"></SortIcons>
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
                        {{ new Date(item.created_at).toLocaleDateString('en-CA') }}
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
                    <td class="px-6 py-4" v-if="routes == 'categories'">
                        <label class="relative inline-flex items-center cursor-pointer ml-2">
                            <input type="checkbox" value="" class="sr-only peer"
                                :checked="item.display == '1' ? true : false" @click="emit('checkbox', item.id)">
                            <div
                                class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Teleport to="body">
        <AlertModal v-if="activeAlertModal" :id="item_id" @close="closeModal()" @confirm="confirm_delete_item">
        </AlertModal>
    </Teleport>
</template>
<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AlertModal from '../layouts/Modals/AlertModal.vue'
import SortIcons from '../layouts/Icons/SortIcons.vue'

const props = defineProps({
    page_name:String,
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