<template>
  <Menu as="div" class="relative">
    <div>
      <MenuButton
        class="group relative inline-block px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
      >
        <font-awesome-icon icon="fa-solid fa-gear" class="mr-1" />
        <TheTooltip text="Settings"></TheTooltip>
      </MenuButton>
    </div>
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <MenuItems
        class="absolute left-0 z-10 mt-2 w-36 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-white ring-opacity-5 focus:outline-none font-medium"
      >
        <MenuItem>
          <Link
            href="/categories"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem"
          >
            <font-awesome-icon icon="fa-solid fa-cart-shopping" class="mr-1" />
            <div class="inline-flex items-center">Payements</div>
          </Link>
        </MenuItem>
        <MenuItem>
          <Link
            href="/invoice"
            class="font-medium block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem"
          >
            <font-awesome-icon icon="fa-solid fa-file-invoice" class="mr-2"/>
            <div class="inline-flex items-center">Invoice</div>
          </Link>
        </MenuItem>
        <MenuItem>
          <Link
            href="/categoryexpences"
            class="font-medium block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem"
          >
            <font-awesome-icon icon="fa-solid fa-receipt" class="mr-2"/>
            <div class="inline-flex items-center">Receipt</div>
          </Link>
        </MenuItem>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
</script>