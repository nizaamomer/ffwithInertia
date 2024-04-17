<template>
    <head> </head>
    <div
        class="px-5 py-10 grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 flex-row text-center flex-wrap justify-between align-middle gap-5"
    >
        <router-link
            :to="{ name: 'report.invoices' }"
            class="bg-indigo-700 hover:bg-indigo-800 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-cart-shopping sm:text-4xl text-2xl bg-indigo-500 text-gray-300 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-300 space-y-4">
                <p>{{ data?.saletoday?.toLocaleString() }} د.ع</p>
                <p class="sm:text-base text-sm">کۆی فرۆشی ئەمڕۆ</p>
            </div>
        </router-link>

        <router-link
            :to="{ name: 'category.index' }"
            class="bg-violet-600 hover:bg-violet-700 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-boxes-stacked sm:text-4xl text-2xl bg-violet-400 text-gray-200 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-200 space-y-4">
                <p>{{ data?.category }}</p>
                <p class="sm:text-lg text-sm">پۆلەکان</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'food.index' }"
            class="bg-blue-500 hover:bg-blue-600 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-utensils sm:text-4xl text-2xl bg-blue-400 text-gray-200 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-200 space-y-4">
                <p>{{ data?.food }}</p>
                <p class="sm:text-lg text-sm">خواردنەکان</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'offer.index' }"
            class="bg-yellow-700 hover:bg-yellow-800 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-tag sm:text-4xl text-2xl bg-yellow-600 text-gray-200 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-200 space-y-4">
                <p>{{ data?.offer }}</p>

                <p class="sm:text-lg text-sm">ئۆفەرەکان</p>
            </div>
        </router-link>

        <router-link
            :to="{ name: 'user.index' }"
            class="bg-rose-600 hover:bg-rose-700 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-users-gear sm:text-4xl text-2xl bg-rose-500 text-gray-200 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-200 space-y-4">
                <p>{{ data?.user }}</p>

                <p class="sm:text-lg text-sm">بەکارهێنەران</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'report.invoices' }"
            class="bg-indigo-700 hover:bg-indigo-800 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-cart-shopping sm:text-4xl text-2xl bg-indigo-500 text-gray-300 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-300 space-y-4">
                <p>{{ data?.salemonth?.toLocaleString() }} د.ع</p>
                <p class="sm:text-base text-sm">کۆی فرۆشی ئەم مانگە</p>
            </div>
        </router-link>
        <router-link
            :to="{ name: 'expense.index' }"
            class="bg-teal-600 hover:bg-teal-700 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center"
        >
            <i
                class="fa-solid fa-wallet sm:text-4xl text-2xl bg-teal-400 text-gray-200 rounded-md px-4 py-3"
            ></i>
            <div class="text-md sm:text-2xl text-right text-gray-200 space-y-4">
                <p>{{ data?.expense?.toLocaleString() }} د.ع</p>
                <p class="sm:text-lg text-sm">کۆی خەرجی ئەم مانگە</p>
            </div>
        </router-link>
     
    </div>
</template>

<script setup>
import useDashboard from "@/composables/dashboard";
import { onMounted } from "vue";
const { getData, data } = useDashboard();
onMounted(() => {
    getData();
});
</script>
