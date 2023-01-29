<template>
    <div class="bg-gray-100 w-full h-full">
        <TheNavbar />
        <div
            class="mx-auto mt-20 w-3/4 bg-white border border-gray-200 rounded-3xl shadow-lg sm:p-6 md:p-2 dark:bg-gray-800 dark:border-gray-700">
            <div class="w-48 mt-8 p-2 text-center ml-32 bg-color-gray-100 sm:p-8 dark:bg-gray-800">
                <h5 class="mb-1 text-2xl font-bold text-gray-700 dark:text-white">STORES :</h5>
            </div>
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <StoreCard />
            <Pagination class="mt-12 ml-50 border 1x border-red" :links="stores.links" />
        </div>
    </div>
    <StoreModal v-if="activeModal"></StoreModal>
</template>  

<script setup>
import StoreCard from '../../components/StoreCard.vue'
import StoreModal from '../../layouts/Dashboard/StoreModal.vue'
import Pagination from '@/Components/Pagination.vue'
import {ref} from 'vue'

const activeModal = ref(false);
const props = defineProps({
    stores: Object,
})
</script>
<style scoped>
.background {
    background-image: url('images/1624847.jpg');
    object-fit: cover;
}
</style>