<template>
  <Base>
    <div>
      <TheNavbar />
      
      <div
        id="root"
        class="min-h-100vh cloak flex grow bg-slate-50 dark:bg-navy-900 pb-5"
      >
      
        <main class=" w-full px-8 pb-5 ">
        <BreadcumberComponent
          class="mt-10 ml-16"
          :menu="['Zones']"
        ></BreadcumberComponent>
          <ZoneComponent v-for="zone in zones" :key="zone.id" :zone="zone" :tables="tables" ></ZoneComponent>
        </main>
      </div>
    </div>
  </Base>
</template>

<script setup>
import ZoneComponent from "../components/Zone/ZoneComponent.vue";
import BreadcumberComponent from "../components/BreadcumberComponent.vue";

const props = defineProps({
  tables: Object,
  filters: Object,  
  zones: Object,
  per_pages: Object,
  errors: Object,
});

</script>

<style scoped>
@import "/public/css/app.css";
</style>