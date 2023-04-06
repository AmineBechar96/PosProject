<style scoped>
.background {
  background-image: url("images/1624847.jpg");
  object-fit: cover;
}

.filter-search-form .icons {
  position: absolute;
  top: 48%;
  z-index: 1;
  --tw-translate-y: -50%;
  -webkit-transform: translate(var(--tw-translate-x), var(--tw-translate-y))
    rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y))
    scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
  transform: translate(var(--tw-translate-x), var(--tw-translate-y))
    rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y))
    scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
  font-size: 20px;
  --tw-text-opacity: 1;
  color: rgb(79 70 229 / var(--tw-text-opacity));
}
[dir="ltr"] .filter-search-form .icons {
  left: 0.75rem;
}
[dir="rtl"] .filter-search-form .icons {
  right: 0.75rem;
}
.filter-search-form .choices__inner {
  height: 60px;
  border-radius: 0px;
  border-width: 0px;
  padding-top: 13px;
  padding-bottom: 15px;
  font-size: 15px;
  --tw-shadow: 0 0 #0000;
  --tw-shadow-colored: 0 0 #0000;
  -webkit-box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
    var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
    var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}
[dir="ltr"] .filter-input-box,
[dir="ltr"] .filter-input-box.form-select,
[dir="ltr"] .filter-search-form .choices__inner {
  padding-right: 6px;
  padding-left: 45px;
}
[dir="rtl"] .filter-input-box,
[dir="rtl"] .filter-input-box.form-select,
[dir="rtl"] .filter-search-form .choices__inner {
  padding-left: 6px;
  padding-right: 45px;
}
</style>



<template>
  <Base>
    <div class="bg-white w-full h-full">
      <TheNavbar />
      <!-- Start Hero -->
      <section
        class="relative table w-full py-32 lg:py-36 bg-[url('/resources/css/images/01.jpg')] bg-no-repeat bg-center"
      >
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="container">
          <div class="grid grid-cols-1 text-center mt-10">
            <h3
              class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white"
            >
              All Stores
            </h3>
          </div>
          <!--end grid-->
        </div>
        <!--end container-->
      </section>
      <!--end section-->
      <div class="relative">
        <div
          class="shape absolute right-0 sm:-bottom-px -bottom-[2px] left-0 overflow-hidden z-1 text-white dark:text-slate-900"
        >
          <svg
            class="w-full h-auto"
            viewBox="0 0 2880 48"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z"
              fill="currentColor"
            ></path>
          </svg>
        </div>
      </div>
      <div class="container relative -mt-16 z-1">
        <div class="grid grid-cols-1">
          <div
            class="p-6 bg-white dark:bg-slate-900 rounded-md shadow-md dark:shadow-gray-800"
          >
            <form action="#">
              <div class="registration-form text-dark text-start">
                <div
                  class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-6 gap-6 mx-auto"
                >
                  <div class="filter-search-form relative filter-border">
                    <i class="uil uil-search icons"></i>
                    <input
                      name="name"
                      type="text"
                      id="job-keyword"
                      class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0"
                      placeholder="Search your keywords"
                    />
                  </div>
                </div>
                <!--end grid-->
              </div>
              <!--end container-->
            </form>
          </div>
        </div>
        <!--end grid-->
      </div>
      <!--end container-->
      <!-- End Hero -->

      <!-- Start -->
      <section class="relative lg:py-16 py-12">
        <div class="container">
          <StoreCard :data="store" v-for="store in stores.data" :key="store.id" />
          <Pagination
            class="mt-12 ml-50 border 1x border-red"
            :links="stores.links"
          />
        </div>
        <!--end container-->
      </section>
      <!--end section-->
      <!-- End -->
    </div>
  </Base>
</template>  

<script setup>
import StoreCard from "../../components/StoreCard.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  stores: Object,
});
</script>
<style scoped>
  @import "/public/css/tailwind.css";
  @import "/public/css/icons.css";
  @import "/public/css/line.css";
</style>