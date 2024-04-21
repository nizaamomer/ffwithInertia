<template>
    <Nav/>
    <div class="w-full overflow-auto bg-slate-900">
        <div
            class="bg-slate-700 w-full md:w-5/6 mx-auto text-gray-300 rounded overflow-hidden text-center text-base p-2 m-2.5"
        >
            <div
                class="flex flex-wrap items-center justify-between min-w-full pb-2 gap-y-2"
            >
                <div
                    class="relative flex flex-wrap items-center justify-between space-x-1 space-x-reverse gap-y-2"
                >
                    <InputSearch
                        @searchFunc="searchFunc"
                        v-model.trim="search"
                    />
                    <button
                        @click="showDate = !showDate"
                        type="button"
                        class="py-2.5 w-auto px-4 text-sm bg-sky-800 hover:bg-sky-900 cursor-pointer font-medium whitespace-nowrap rtl:ml-2 text-white focus:outline-none rounded-lg"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"
                            />
                        </svg>
                    </button>
                    <div
                        v-if="showDate"
                        class="absolute left-0 z-10 inline-block py-2 space-y-2 text-sm text-gray-500 duration-300 bg-gray-900 rounded-lg shadow-sm top-10 w-34"
                    >
                        <select
                            name="date_range"
                            size="5"
                            v-model="dateRange"
                            @change="changeOption"
                            class="w-full h-40 space-y-2 text-center bg-gray-900 border-none outline-none focus:outline-none"
                        >
                            <option
                                class="font-semibold rounded checked:bg-emerald-600 checked:text-gray-800"
                                value="today"
                            >
                                ئــەمڕۆ
                            </option>
                            <option
                                class="font-semibold rounded checked:bg-emerald-600 checked:text-gray-800"
                                value="this_week"
                            >
                                ئـەم هــەفتەیە
                            </option>
                            <option
                                class="font-semibold rounded checked:bg-emerald-600 checked:text-gray-800"
                                value="last_week"
                            >
                                کــۆتا هــەفتە
                            </option>
                            <option
                                class="font-semibold rounded checked:bg-emerald-600 checked:text-gray-800"
                                value="this_month"
                            >
                                ئـەم مــانگە
                            </option>
                            <option
                                class="font-semibold rounded checked:bg-emerald-600 checked:text-gray-800"
                                value="last_month"
                            >
                                کــۆتا مــانگ
                            </option>
                        </select>
                        <button
                            id="showrange"
                            type="button"
                            class="inline-block my-3 text-base font-semibold rounded checked:bg-indigo-500 checked:text-white"
                            @click="isFormVisible = !isFormVisible"
                        >
                            مەودای تایبەت
                        </button>
                        <!-- Additional inputs for custom range if selected -->
                        <div v-if="isFormVisible" class="space-y-2 text-center">
                            <input
                                type="date"
                                v-model="customStartDate"
                                @change="changeOption"
                                class="block mx-auto space-y-2 text-center bg-gray-800 border-0 rounded outline-none focus:outline-none"
                            />
                            <input
                                type="date"
                                v-model="customEndDate"
                                @change="changeOption"
                                class="block mx-auto space-y-2 text-center bg-gray-800 border-0 rounded outline-none focus:outline-none"
                            />
                        </div>

                        <div>
                            <button
                                class="px-4 py-1 text-center text-gray-200 rounded bg-rose-600"
                                type="submit"
                                @click.prevent="reset"
                            >
                                Reset
                            </button>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    <button
                        @click.prevent="reset"
                        type="button"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg cursor-pointer bg-rose-800 hover:bg-rose-900 whitespace-nowrap rtl:ml-2 focus:outline-none"
                    >
                        reset
                    </button>
                </div>
                <button
                @click.prevent="exportToPdf"
                        class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800"
                        type="button"
                    >
                        PDF
                    </button>
            </div>
            <div
                class="bg-slate-700 text-gray-300 pb-10 sm:pb-0.5 rounded text-center text-base gap-2 overflow-auto"
            >
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div
                        class="relative overflow-y-scroll h-[77vh] scroll-smooth rounded-md"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 rtl:text-right"
                        >
                            <thead
                                class="sticky top-0 text-sm text-gray-500 uppercase bg-gray-900"
                            >
                                <tr
                                    class="truncate divide-x divide-x-reverse divide-indigo-400"
                                >
                                    <th scope="col" class="px-6 py-3">
                                        جـــۆری خــەرجــی
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        بــڕی پــارە
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        کـــات و بــەروار
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        تێبـــینی
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="expenses.length > 0">
                                <tr
                                    v-for="item in expenses"
                                    :key="item.id"
                                    class="w-full border-b border-indigo-500 bg-slate-900 hover:border-y-2 hover:border-rose-800"
                                >
                                    <th
                                        scope="row"
                                        class="flex items-center px-6 py-2 pt-3 pr-0 space-x-3 space-x-reverse text-center rtl:pr-3"
                                    >
                                        {{ item.name }}
                                    </th>
                                    <td class="px-6 py-4 text-center truncate">
                                        {{ item.amount.toLocaleString() }}
                                        <span class="text-indigo-500">
                                            د.ع
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center truncate">
                                        {{ item.date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{
                                            item.description
                                                ? item.description
                                                : "هیچ تێبینیەک نەنووسراوە"
                                        }}
                                    </td>
                                    <!-- @if (auth()->user()->hasPermissionTo('Expense Edit') ||
                                    auth()->user()->hasPermissionTo('Expense Delete')) -->
                                </tr>
                                <tr v-if="nextPageUrl" class="bg-slate-900">
                                    <td colspan="100%" class="p-2 text-center">
                                        <button
                                            @click="loadMore"
                                            class="text-gray-200 bg-rose-600 hover:bg-gray-800 hover:text-rose-500 px-8 py-1.5 rounded-lg font-bold"
                                        >
                                            زیــاتــر...
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                            <div
                                v-else
                                class="absolute left-0 right-0 mx-auto mt-24 text-lg text-center text-gray-400"
                            >
                                هیچ خــەرجیــەک بەردەست نییــە
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";

import Nav from "./nav.vue"
import InputSearch from "@/Components/inputSearch.vue";

const {
    isFormVisible,
    searchFunc,
    loadMore,
    showDate,
    search,
    reset,
    changeOption,
    dateRange,exportToPdf,
    customStartDate,
    customEndDate,
    getExpenses,
    expenses,
} = useExpenses();

onMounted(() => {
    getExpenses();
});
</script>
