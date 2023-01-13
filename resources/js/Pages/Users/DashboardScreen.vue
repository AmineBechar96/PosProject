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
        </div>
    </div>
    <button @click="activeModal = true">AW {{ activeModal }}</button>
    <StoreModal v-if="activeModal"></StoreModal>
</template>  

<script setup>
import StoreCard from '../../components/StoreCard.vue';
import StoreModal from '../../layouts/Dashboard/StoreModal.vue'
import {ref} from 'vue'
const activeModal = ref(false);
</script>
<style scoped>
.background {
    background-image: url('images/1624847.jpg');
    object-fit: cover;
}
</style>