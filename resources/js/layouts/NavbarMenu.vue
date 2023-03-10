<template>
    <Link :key="item.name" :href="item.href" v-if="item.subMenu == 'monoMenu'"
        :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-700 hover:text-white', 'px-2 py-2 rounded-md text-sm font-medium']"
        :aria-current="item.current ? 'page' : undefined"><font-awesome-icon class="mr-1" :icon="item.icon" />
        {{ item.name }}
    </Link>
    <Menu as="div" class="relative ml-6" v-if="item.subMenu == 'multiMenuPeople'">
        <div>
            <MenuButton
            :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']">
                <font-awesome-icon class="mr-1" :icon="item.icon" />
                {{ item.name }}
            </MenuButton>
        </div>
        <transition enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute left-0 z-10 mt-2 w-36 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none font-medium">
                <MenuItem v-slot="{ active }">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <div class="inline-flex items-center">
                        WAITERS
                    </div>
                </a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <div class="inline-flex items-center">
                        CUSTOMERS
                    </div>
                </a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <div class="inline-flex items-center">
                        SUPPLIERS
                    </div>
                </a>
                </MenuItem>
            </MenuItems>
        </transition>
    </Menu>
    <Menu as="div" class="relative ml-6" v-if="item.subMenu == 'multiMenuCategory'">
        <div>
            <MenuButton
            :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']">
                <font-awesome-icon class="mr-1" :icon="item.icon" />
                {{ item.name }}
            </MenuButton>
        </div>
        <transition enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute left-0 z-10 mt-2 w-36 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none font-medium">
                <MenuItem v-slot="{ active }">
                <Link href="/categories"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <div class="inline-flex items-center">
                        PRODUCT
                    </div>
                </Link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                <Link href="/categoryexpences"
                    class="font-medium block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <div class="inline-flex items-center">
                        EXPENSE
                    </div>
                </Link>
                </MenuItem>
            </MenuItems>
        </transition>
    </Menu>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
const props = defineProps({
    item: Object
})
</script>