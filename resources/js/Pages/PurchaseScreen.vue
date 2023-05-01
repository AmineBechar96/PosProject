<template>
    <Base>
      <div>
        <div class="bg-gray-100 w-screen">
          <TheNavbar />
          <BreadcumberComponent
            class="mt-6 ml-20"
            :menu="[menu]"
          ></BreadcumberComponent>
          <div
            class="
              mx-auto
              mt-12
              w-3/4
              bg-white
              border border-gray-200
              rounded-3xl
              shadow-lg
              p-6
              md:p-10
              dark:bg-gray-800 dark:border-gray-700
            "
          >
            <div class="sm:flex sm:items-center sm:justify-between pb-2 mb-2">
              <DropdownComponent
                :filters="filters"
                routes="purchases"
                @filter="filter"
              ></DropdownComponent>
              <SearchInput
                :filters="filters"
                routes="purchases"
                @filter="filter"
              ></SearchInput>
            </div>
            <div class="flex items-center">
              <SaleTable
                :routes="page_name"
                :data="purchases"
                :page_name="page_name"
                @edit_item="edit_item"
                @filter="filter"
              >
              </SaleTable>
            </div>
            <nav
              class="sm:flex sm:items-center sm:justify-between pt-4"
              aria-label="Table navigation"
            >
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
                >Showing
                <span class="font-semibold text-gray-900 dark:text-white"
                  >{{ purchases.from }}-{{ purchases.to }}</span
                >
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{
                  purchases.total
                }}</span></span
              >
              <Pagination class="mt-12 ml-50" :links="purchases.links" />
            </nav>
          </div>
        </div>
        <Teleport to="body">
          <EditModalPurchase
            :page_name="page_name"
            :open="activeEditModal"
            :customers="customers"
            :purchases="purchases"
            :errors="errors"
            @close="closeModal(2)"
            @update="update_item"
            :items="items"
          ></EditModalPurchase>
        </Teleport>
      </div>
    </Base>
  </template>
  
  <script setup>
  import BreadcumberComponent from "../components/BreadcumberComponent.vue";
  import DropdownComponent from "../components/DropdownComponent.vue";
  import SearchInput from "../components/SearchInput.vue";
  import SaleTable from "../components/Table/SaleTable.vue";
  import Pagination from "../components/Pagination.vue";
  
  import EditModalPurchase from "../layouts/Modals/Edit/EditModalPurchase.vue";
  import AddModalPurchase from "../layouts/Modals/Add/AddModalPurchase.vue";
  
  
  import { router } from "@inertiajs/vue3";
  import { ref } from "vue";
  const props = defineProps({
    page_name: String,
    purchases: Object,
    filters: Object,  
    customers: Object,
    per_pages: Object,
    errors: Object,
    dat: Object,
  });
  
  const activeEditModal = ref(false);
  const per_page_ref = ref(5);
  const column_ref = ref("id");
  const direction_ref = ref("asc");
  const search_ref = ref("");
  
  const items = ref({});
  const menu = "Purchases";
  
  function closeModal(id) {
    props.errors.name = null;
    if (id == 2) {
      activeEditModal.value = false;
    }
  }
  
  function edit_item(item) {
    items.value = item;
    activeEditModal.value = true;
  }
  
  function update_item(items) {
    router.put(
      props.page_name + items["id"],
      { items: items },
      {
        replace: true,
        preserveScroll: true,
        preserveState: true,
        onFinish: () => (activeEditModal.value = false),
      }
    );
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
    router.get(
      props.page_name,
      {
        column: column_ref.value,
        direction: direction_ref.value,
        per_pages: per_page_ref.value,
        search: search_ref.value,
      },
      {
        preserveState: true,
        preserveScroll: true,
        replace: true,
      }
    );
  }
  </script>