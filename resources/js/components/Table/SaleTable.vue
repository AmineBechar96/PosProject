<template>
  <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg mt-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="
          text-xs text-gray-700
          uppercase
          bg-gray-50
          dark:bg-gray-700 dark:text-gray-400
        "
      >
        <tr>
          <th
            scope="col"
            class="px-6 py-3 cursor-pointer"
            @click="sort('id')"
          >
          <div class="flex justify-evenly">
            <span class="mr-2">Number</span>
            <SortIcons
              :column="column"
              column_selected="id"
              :direction="direction"
            ></SortIcons>
            </div>
          </th>
          <th
            scope="col"
            class="px-5 py-3 cursor-pointer"
            @click="sort('name')"
          >
          <div class="flex justify-evenly">
            <span v-if="page_name == 'purchases'" class="mr-2">Supplier</span>
            <span v-else class="mr-2">Customer</span>
            <SortIcons
              :column="column"
              column_selected="name"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th
            scope="col"
            class="px-6 py-3 cursor-pointer"
            @click="sort('tax')"
          >
          <div class="flex justify-evenly">
            <span class="mr-2">Tax</span>
            <SortIcons
              :column="column"
              column_selected="tax"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th
            scope="col"
            class="px-4 py-3 cursor-pointer"
            @click="sort('discount')"
          >
          <div class="flex justify-evenly">
            <span class="mr-2">Discount</span>
            <SortIcons
              :column="column"
              column_selected="discount"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th
            scope="col"
            class="px-6 py-3 cursor-pointer"
            @click="sort('total')"
          >
          <div class="flex justify-evenly">
            <span class="mr-2">Total</span>
            <SortIcons
              :column="column"
              column_selected="total"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            <span>Action</span>
          </th>
          <th
            scope="col"
            class="px-6 py-3 cursor-pointer"
            @click="sort('username')"
          >
          <div class="flex justify-around">
            <span class="mr-2">Created By</span>
            <SortIcons
              :column="column"
              column_selected="username"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th
            scope="col"
            class="px-4 py-3 cursor-pointer"
            @click="sort('total_items')"
          >
          <div class="flex justify-around">
            <span class="mr-2">Total Items</span>
            <SortIcons
              :column="column"
              column_selected="total_items"
              :direction="direction"
            ></SortIcons>
          </div>
          </th>
          <th
            scope="col"
            class="px-6 py-3 cursor-pointer"
            @click="sort('status')"
          >
            <div class="flex justify-around">
              <span class="mr-2">Status</span>
            <SortIcons
              :column="column"
              column_selected="name"
              :direction="direction"
            ></SortIcons>
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in data.data"
          :key="item.id"
          class="
            bg-white
            border-b
            dark:bg-gray-800 dark:border-gray-700
            hover:bg-gray-50
            dark:hover:bg-gray-600
          "
        >
          <th
            scope="row"
            class="
              px-6
              py-4
              font-medium
              text-md text-gray-900
              whitespace-nowrap
              dark:text-white
            "
          >
            {{ item.id }}
          </th>
          <td class="px-6 py-4">
            {{ item.name }}
          </td>
          <td class="px-6 py-4">
            {{ item.tax + " %" }}
          </td>
          <td class="px-6 py-4">
            {{ item.discount + " %" }}
          </td>
          <td class="px-6 py-4">
            {{ item.total }}
          </td>
          <td class="px-6 py-4">
            <div class="inline-flex rounded-md shadow-sm" role="group">
              <button
                type="button"
                @click="delete_item(item.id)"
                class="
                  group
                  relative
                  inline-block
                  px-4
                  py-2
                  text-sm
                  font-medium
                  text-gray-900
                  bg-white
                  border border-gray-200
                  rounded-l-lg
                  hover:bg-gray-100 hover:text-blue-700
                  focus:z-10
                  focus:ring-2
                  focus:ring-blue-700
                  focus:text-blue-700
                  dark:bg-gray-700
                  dark:border-gray-600
                  dark:text-white
                  dark:hover:text-white
                  dark:hover:bg-gray-600
                  dark:focus:ring-blue-500
                  dark:focus:text-white
                "
              >
                <font-awesome-icon icon="fa-solid fa-trash" class="mr-1" />
                <TheTooltip text="Delete"></TheTooltip>
              </button>
              <button
                type="button"
                @click="emit('edit_item', item)"
                class="
                  group
                  relative
                  inline-block
                  px-4
                  py-2
                  text-sm
                  font-medium
                  text-gray-900
                  bg-white
                  border-t border-b border-gray-200
                  hover:bg-gray-100 hover:text-blue-700
                  focus:z-10
                  focus:ring-2
                  focus:ring-blue-700
                  focus:text-blue-700
                  dark:bg-gray-700
                  dark:border-gray-600
                  dark:text-white
                  dark:hover:text-white
                  dark:hover:bg-gray-600
                  dark:focus:ring-blue-500
                  dark:focus:text-white
                "
              >
                <font-awesome-icon
                  icon="fa-solid fa-pen-to-square"
                  class="mr-1"
                />
                <TheTooltip text="Edit"></TheTooltip>
              </button>
              <SubMenuButton :id="item.id" :page_name="page_name"></SubMenuButton>
            </div>
          </td>
          <td class="px-6 py-4">
            {{ item.username }}
          </td>
          <td class="px-6 py-4">
            {{ item.total_items }}
          </td>
          <td class="px-6 py-4">
            <Badge v-if="(item.status == 0)" title="Unpaid" color="secondary"></Badge>
            <Badge v-else-if="(item.status == 1)" title="Partially" color="warning"></Badge>
            <Badge v-else title="Paid" color="success"></Badge>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <Teleport to="body">
    <AlertModal
      v-if="activeAlertModal"
      :id="item_id"
      @close="closeModal()"
      @confirm="confirm_delete_item"
    >
    </AlertModal>
    <SuccessModal
      v-if="activeSuccessModal"
      @close="closeModal()"
    >
    </SuccessModal>
  </Teleport>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import AlertModal from "../../layouts/Modals/AlertModal.vue";
import SuccessModal from "../../layouts/Modals/SucessModal.vue";
import SortIcons from "../../layouts/Icons/SortIcons.vue";
import Badge from "../../layouts/Badge/Badge.vue";
import SubMenuButton from "../../components/MenuButton.vue";

const props = defineProps({
  page_name: String,
  data: Object,
  routes: String,
});

const activeAlertModal = ref(false);
const activeSuccessModal= ref(false);

const item_id = ref(0);
const column = ref("id");
const direction = ref("asc");

function sort(column_1) {
  if (direction.value == "asc") {
    direction.value = "desc";
  } else direction.value = "asc";
  column.value = column_1;
  emit("filter", { column: column.value, direction: direction.value });
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
      onSuccess: () => (activeSuccessModal.value = true),
    });
  }
}
function closeModal() {
  activeSuccessModal.value = false;
}
const emit = defineEmits(["edit_item", "filter"]);
</script>