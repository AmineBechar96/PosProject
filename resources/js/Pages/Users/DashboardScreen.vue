<template>
    <div class="bg-gray-100 w-full h-full">
        <TheNavbar />
        <div
            class="w-48 mt-12 p-2 text-center ml-80 bg-color-gray-100 sm:p-8 dark:bg-gray-800">
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
</template>  

<script>
import StoreCard from '../../components/StoreCard.vue';
export default {
    components: {
        StoreCard
    },
}
</script>
<style scoped>
.background {
    background-image: url('images/1624847.jpg');
    object-fit: cover;
}
</style>