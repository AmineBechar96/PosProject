<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <!-- left side -->
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-5xl font-bold text-purple-400">TASSYIR POS</span>
                <span class="font-light text-gray-400 mb-8">
                    Veuillez Entrer Vos Informations
                </span>
                <div class="py-4">
                    <span class="mb-4 text-md">Username:</span>
                    <input type="text"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                        name="email" id="email" />
                </div>
                <div class="py-4">
                    <span class="mb-4 text-md">Password:</span>
                    <input type="password" name="pass" id="pass"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                </div>
                <div class="flex justify-between w-full py-4">
                    <div class="mr-24">
                        <div class="flex items-center mr-4">
                            <input id="purple-checkbox" type="checkbox" value=""
                                class="w-4 h-4 text-purple-500 bg-gray-100 rounded border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="purple-checkbox"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember Me</label>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300">
                    Sign in
                </button>
            </div>
            <!-- {/* right side */} -->
            <div class="relative">
                <img src="/src/assets/images/login.jpg" alt="img"
                    class="w-[380px] h-full hidden rounded-r-2xl md:block object-cover" />
                <!-- text on image  -->
                <div
                    class="absolute hidden bottom-10 right-6 p-5 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block">
                    <span class="font-light text-black-100 mb-8">© 2022 AGENCE TASSYIR<br />
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script></script>