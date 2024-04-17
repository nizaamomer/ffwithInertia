<template>
    <div class="border-b border-gray-500">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-2">
            <li class="mr-2">
                <router-link
                    :to="{ name: 'report.invoices' }"
                    active-class="bg-indigo-800 text-gray-300 p-4 border-b-2 border-pink-800"
                    class="inline-block text-white p-4 border-b-2 border-transparent rounded-t-lg hover:text-rose-600 hover:border-gray-300"
                    >وەســڵەکان</router-link
                >
            </li>

            <li class="mr-2">
                <router-link
                    :to="{ name: 'report.expenses' }"
                    active-class="bg-indigo-800 text-gray-300 p-4 border-b-2 border-pink-800"
                    class="inline-block text-white p-4 border-b-2 border-transparent rounded-t-lg hover:text-rose-600 hover:border-gray-300"
                    >خــەرجیـیـەکان</router-link
                >
            </li>
        </ul>
    </div>
</template>