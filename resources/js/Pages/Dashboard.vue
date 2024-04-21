<template>
    <head> </head>
    <div
        class="grid flex-row flex-wrap justify-between grid-cols-1 gap-5 px-5 py-10 text-center align-middle lg:grid-cols-3 md:grid-cols-2"
    >
        <router-link
            :to="{ name: 'report.invoices' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 bg-indigo-700 rounded-lg hover:bg-indigo-800 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-300 bg-indigo-500 rounded-md fa-solid fa-cart-shopping sm:text-4xl"
            ></i>
            <div class="space-y-4 text-right text-gray-300 text-md sm:text-2xl">
                <p>{{ data?.saletoday?.toLocaleString() }} د.ع</p>
                <p class="text-sm sm:text-base">کۆی فرۆشی ئەمڕۆ</p>
            </div>
        </router-link>

        <router-link
            :to="{ name: 'category.index' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 rounded-lg bg-violet-600 hover:bg-violet-700 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-200 rounded-md fa-solid fa-boxes-stacked sm:text-4xl bg-violet-400"
            ></i>
            <div class="space-y-4 text-right text-gray-200 text-md sm:text-2xl">
                <p>{{ data?.category }}</p>
                <p class="text-sm sm:text-lg">پۆلەکان</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'food.index' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 bg-blue-500 rounded-lg hover:bg-blue-600 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-200 bg-blue-400 rounded-md fa-solid fa-utensils sm:text-4xl"
            ></i>
            <div class="space-y-4 text-right text-gray-200 text-md sm:text-2xl">
                <p>{{ data?.food }}</p>
                <p class="text-sm sm:text-lg">خواردنەکان</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'offer.index' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 bg-yellow-700 rounded-lg hover:bg-yellow-800 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-200 bg-yellow-600 rounded-md fa-solid fa-tag sm:text-4xl"
            ></i>
            <div class="space-y-4 text-right text-gray-200 text-md sm:text-2xl">
                <p>{{ data?.offer }}</p>

                <p class="text-sm sm:text-lg">ئۆفەرەکان</p>
            </div>
        </router-link>

        <router-link
            :to="{ name: 'user.index' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 rounded-lg bg-rose-600 hover:bg-rose-700 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-200 rounded-md fa-solid fa-users-gear sm:text-4xl bg-rose-500"
            ></i>
            <div class="space-y-4 text-right text-gray-200 text-md sm:text-2xl">
                <p>{{ data?.user }}</p>

                <p class="text-sm sm:text-lg">بەکارهێنەران</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'report.invoices' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 bg-indigo-700 rounded-lg hover:bg-indigo-800 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-300 bg-indigo-500 rounded-md fa-solid fa-cart-shopping sm:text-4xl"
            ></i>
            <div class="space-y-4 text-right text-gray-300 text-md sm:text-2xl">
                <p>{{ data?.salemonth?.toLocaleString() }} د.ع</p>
                <p class="text-sm sm:text-base">کۆی فرۆشی ئەم مانگە</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'expense.index' }"
            class="flex items-center justify-around px-3 py-6 text-lg font-semibold text-gray-800 bg-teal-600 rounded-lg hover:bg-teal-700 sm:px-0 shado-lg"
        >
            <i
                class="px-4 py-3 text-2xl text-gray-200 bg-teal-400 rounded-md fa-solid fa-wallet sm:text-4xl"
            ></i>
            <div class="space-y-4 text-right text-gray-200 text-md sm:text-2xl">
                <p>{{ data?.expense?.toLocaleString() }} د.ع</p>
                <p class="text-sm sm:text-lg">کۆی خەرجی ئەم مانگە</p>
            </div>
        </router-link>
    </div>
</template>

<script setup>
defineProps(["data"]);
</script>
