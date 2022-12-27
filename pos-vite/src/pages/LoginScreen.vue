<template>
    <div class="flex items-center justify-center min-h-screen bg-cover bg-center dark:bg-gray-400" :style="{
    'background-image': `url('/src/assets/images/login2.jpg')`,}">
        <div class="relative flex flex-col m-6 space-y-8 bg-gray-100 shadow-2xl rounded-2xl md:flex-row md:space-y-0 opacity-90 dark:bg-gray-700">
            <div class="flex flex-col justify-center p-8 w-[400px] md:p-16">
                <img src="/src/assets/images/tassyir.png" alt="img"
                    class="w-[220px] hidden ml-2 rounded-r-2xl sm:block object-cover" />
                <span class="font-light text-gray-800 mb-4 mt-8 dark:text-white">
                    Veuillez Entrer Vos Informations:
                </span>
                <form @submit.prevent="onSubmit">
                    <div class="py-2">
                        <label for="username-icon"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username:</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <input type="text" id="username-icon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Username">
                        </div>
                    </div>
                    <div class="py-4">
                        <label for="password-icon"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="25px" height="20px">
                                    <linearGradient id="_GYgCJFiT8uK5A9BM5oJ9a" x1="19.269" x2="30.928" y1="4.096"
                                        y2="44.351" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#737b80" />
                                        <stop offset="1" stop-color="#575c61" />
                                    </linearGradient>
                                    <path fill="url(#_GYgCJFiT8uK5A9BM5oJ9a)"
                                        d="M25.794,35.293l11.468-9.483C37.73,25.424,38,24.849,38,24.244v-7.495 C35.606,3.539,24,3.93,24,3.93S12.394,3.539,10,16.748v7.496c0,0.606,0.27,1.18,0.737,1.567l11.468,9.483 C23.247,36.155,24.753,36.154,25.794,35.293z M16,17.21c1.624-6.501,8-6.59,8-6.59s6.376,0.089,8,6.59v4.861H16V17.21z" />
                                    <linearGradient id="_GYgCJFiT8uK5A9BM5oJ9b" x1="15.33" x2="26.989" y1="5.237"
                                        y2="45.492" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#737b80" />
                                        <stop offset="1" stop-color="#575c61" />
                                    </linearGradient>
                                    <path fill="url(#_GYgCJFiT8uK5A9BM5oJ9b)"
                                        d="M27.045,36.7c-0.883,0.723-1.964,1.084-3.045,1.084s-2.163-0.361-3.045-1.084L10,27.723V42.5 c0,0,0.079,1.571,1.781,1.571c1.701,0,12.22,0,12.22,0s10.518,0,12.219,0C37.921,44.071,38,42.5,38,42.5V27.722L27.045,36.7z" />
                                </svg>
                            </div>
                            <input type="password" id="password-icon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="flex justify-between w-full py-5">
                        <div class="mr-24">
                            <div class="flex items-center mr-4">
                                <input id="purple-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-purple-500 bg-gray-100 rounded border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="purple-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                    Me</label>
                            </div>
                        </div>
                    </div>
                    <button
                        class="w-full bg-black text-white p-2 rounded-lg mb-7 hover:bg-gray-100 dark:bg-black hover:text-black hover:border hover:border-gray-300 dark:hover:bg-gray-100">
                        Sign in
                    </button>
                </form>
                <div
                    class="absolute hidden bottom-2 ml-5 p-4 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block dark:bg-black-200">
                    <span class="font-light text-black-100 mb-1 text-sm font-medium dark:text-white">© 2022 AGENCE TASSYIR<br />
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>

</style>
<script>
export default {
    methods: {
        onSubmit() {
            console.log("sign in");
        }
    }
}
</script>