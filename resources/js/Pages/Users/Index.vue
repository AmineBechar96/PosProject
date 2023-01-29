<template>
    <Head>
        <title>Login Project</title>
    </Head>
    <div class="flex items-center justify-center min-h-screen bg-cover bg-center dark:bg-gray-400" :style="{
    'background-image': `url('images/login2.jpg')`,
}">
        <div
            class="relative flex flex-col m-6 space-y-8 bg-gray-100 shadow-2xl rounded-2xl md:flex-row md:space-y-0 opacity-90 dark:bg-gray-700">
            <div class="flex flex-col justify-center p-8 w-[400px] md:p-16">
                <img :src="'/images/tassyir.png'" alt="img"
                    class="w-[220px] hidden ms-2 rounded-e-2xl sm:block object-cover" />
                <span class="font-light text-gray-800 mb-4 mt-8 dark:text-white">
                    Veuillez Entrer Vos Informations:
                </span>
                <p class="mt-0 text-sm text-red-600 dark:text-red-500">{{errors.username}}</p>
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{errors.password}}</p>
                
                <form @submit.prevent="form.post(route('login.post'))">
                    <div class="py-2">
                        <label for="username-icon"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username:</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 start-0 items-center ps-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <input type="text" id="username-icon" class="text-sm rounded-lg block w-full ps-10 p-2.5"
                                :class="{'bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:placeholder-gray-400':(errors.username == null),'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400':(errors.username != null)}" placeholder="Username" v-model="form.username">
                        </div>
                    </div>
                    <div class="py-4">
                        <label for="password-icon"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 start-0 items-center ps-3 pointer-events-none">
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
                            class="text-sm rounded-lg block w-full ps-10 p-2.5"
                                :class="{'bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:placeholder-gray-400':(errors.password == null),'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400':(errors.password != null)}" placeholder="Password" v-model="form.password">
                        </div>
                    </div>
                    <div class="flex justify-between w-full py-5">
                        <div class="me-24">
                            <div class="flex items-center ms-4">
                                <input id="purple-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-purple-500 bg-gray-100 rounded border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    v-model="form.rememberMe">
                                <label for="purple-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                    Me</label>
                            </div>
                        </div>
                    </div>
                    <button v-if="form.processing" disabled type="button"
                        class="py-2.5 px-5 mb-7 w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
                        <svg aria-hidden="true" role="status"
                            class="inline mr-2 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="#1C64F2" />
                        </svg>
                        Loading...
                    </button>
                    <button v-else
                        class="w-full bg-black text-white p-2 rounded-lg mb-7 hover:bg-gray-100 dark:bg-black hover:text-black hover:border hover:border-gray-300 dark:hover:bg-gray-100">
                        Sign in
                    </button>
                </form>
                <div
                    class="absolute hidden bottom-2 ms-5 p-4 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block dark:bg-black-200">
                    <span class="font-light text-black-100 mb-1 text-sm font-medium dark:text-white">© 2023 AGENCE
                        TASSYIR<br />
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Head, useForm } from '@inertiajs/vue3';
import ModalLogin from '../../components/ModalLogin.vue';

export default {
    components: {
        Head, ModalLogin
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = useForm({
            username: '',
            password: '',
            rememberMe: false,
        });
        const showModal = false;
        return { form, showModal };
    }
}
</script>
