<template>
     <Nav/>
    <div class="w-full overflow-auto bg-slate-900">
        <div
            class="bg-slate-700 w-full h-[87vh] 2xl:h-[90vh] md:w-11/12 mx-auto text-gray-300 rounded overflow-hidden text-center text-base p-2 m-3"
        >
            <div
                class="grid flex-row flex-wrap justify-between grid-cols-2 mb-2 text-center align-middle md:grid-cols-4 lg:gap-x-8 gap-y-2 gap-x-2"
            >
                <div
                    class="flex items-center justify-around p-2 text-lg font-semibold text-gray-800 bg-teal-500 rounded-lg shadow-md sm:px-2"
                >
                    <i
                        class="px-4 py-3 text-xl text-gray-200 bg-teal-400 rounded-md fa-solid fa-boxes-stacked sm:text-2xl"
                    ></i>
                    <div class="text-right text-gray-200 text-md sm:text-lg">
                        <p>
                            {{ invoices.length }}
                        </p>
                        <p class="text-sm">ژمــارەی وەسـڵەکان</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-around p-2 text-lg font-semibold text-gray-800 bg-pink-600 rounded-lg shadow-md sm:px-2"
                >
                    <i
                        class="px-4 py-3 text-xl text-gray-300 bg-pink-400 rounded-md fa-solid fa-cart-shopping sm:text-2xl"
                    ></i>
                    <div class="text-right text-gray-300 text-md sm:text-lg">
                        <p>
                            {{ totalSumInvoice?.toLocaleString() }}
                            <span class="text-gray-800"> د.ع </span>
                        </p>
                        <p class="text-sm">پــارەی گشتی فرۆشراو</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-around p-2 text-lg font-semibold text-gray-800 bg-purple-700 rounded-lg shadow-md sm:px-2"
                >
                    <i
                        class="px-4 py-3 text-xl text-gray-300 bg-purple-500 rounded-md fa-solid fa-cart-plus sm:text-2xl"
                    ></i>
                    <div class="text-right text-gray-300 text-md sm:text-lg">
                        <p>
                            {{ totalitems?.toLocaleString() }}
                            <span class="text-gray-800"> دانــە </span>
                        </p>
                        <p class="text-sm sm:text-base">ژمــارەی خـواردنەکان</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-around p-2 text-lg font-semibold text-gray-800 bg-red-500 rounded-lg shadow-md"
                >
                    <i
                        class="px-4 py-3 text-xl text-gray-300 bg-red-400 rounded-md fa-solid fa-shop sm:text-2xl"
                    ></i>
                    <div class="text-right text-gray-300 text-md sm:text-lg">
                        <p>
                            {{ totalSumDiscount?.toLocaleString() }}
                            <span class="text-gray-800"> د.ع </span>
                        </p>
                        <p class="text-sm">کــۆی داشـكانـدن</p>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-wrap items-center justify-between min-w-full pb-3 gap-y-2"
            >
                <div
                    class="relative flex flex-wrap items-center justify-between space-x-2 space-x-reverse w-fit gap-y-2"
                >
                    <select
                        id="user_id"
                        name="user_id"
                        v-model="user_id"
                        @change="changeOption"
                        class="block w-2/6 py-2 text-sm text-gray-300 border border-none rounded-lg bg-slate-800 md:w-auto focus:bg-gray-900 focus:ring-rose-500 focus:border-rose-500"
                    >
                        <option value="">دیـاریکردنی کـاشێر</option>
                        <option
                            v-for="user in users"
                            :key="user.id"
                            :value="user.id"
                        >
                            {{ user.name }}
                        </option>
                    </select>
                    <select
                        id="status"
                        name="status"
                        v-model="status"
                        @change="changeOption"
                        class="block w-2/6 py-2 text-sm text-gray-300 border border-none rounded-lg bg-slate-800 md:w-auto focus:bg-gray-900 focus:ring-rose-500 focus:border-rose-500"
                    >
                        <option value="">شێوازی پــارەدان</option>
                        <option value="cash">حــازر</option>
                        <option value="delivery">دیــلیڤەری</option>
                        <option value="togo">ســەفەری</option>
                    </select>
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
                </div>
                <div
                    class="relative flex items-center justify-between space-x-2 space-x-reverse w-fit"
                >
                    <button
                        @click.prevent="reset"
                        type="button"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg cursor-pointer bg-rose-800 hover:bg-rose-900 whitespace-nowrap rtl:ml-2 focus:outline-none"
                    >
                        reset
                    </button>
                    <InputSearch
                        @searchFunc="searchFunc"
                        v-model.trim="search"
                    />

                    <button
                        @click="openPdf = !openPdf"
                        class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800"
                        type="button"
                    >
                        PDF
                    </button>
                    <!-- Main modal -->
                    <div v-if="openPdf"
                        class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[60] flex justify-center items-center"
                    >
                        <div class="relative w-full max-w-xl max-h-full p-4">
                            <!-- Modal content -->
                            <div>
                                <div
                                    class="relative bg-gray-800 rounded-lg shadow"
                                >
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5"
                                    >
                                        <h3
                                            class="text-2xl font-semibold text-white"
                                        >
                                            بینینی ڕاپۆرت
                                        </h3>
                                        <button
                                            type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg ms-auto hover:bg-gray-600 hover:text-white"
                                            @click="openPdf = false"
                                        >
                                            <svg
                                                class="w-3 h-3"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 14 14"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                                />
                                            </svg>
                                            <span class="sr-only"
                                                >Close modal</span
                                            >
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 space-y-4 md:p-5">
                                        <p
                                            class="text-base leading-relaxed text-gray-300"
                                        >
                                            هەرتێبینیەک داتەوێ لەسەر پەڕەکە
                                            دەربکەوێ لێرەدا بینووسە!
                                        </p>

                                        <textarea
                                            id="message"
                                            rows="4"
                                            name="message"
                                            v-model="note"
                                            class="block p-2.5 w-full text-sm focus:bg-gray-800 rounded-lg border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-indigo-500 focus:border-indigo-500"
                                            placeholder="لێرە بنووسە...."
                                        ></textarea>
                                        <h3
                                            class="mb-4 font-semibold text-white"
                                        >
                                            وردەکاریەکان
                                        </h3>
                                        <ul
                                            class="items-center w-full text-sm font-medium text-white bg-gray-700 border border-gray-600 rounded-lg sm:flex"
                                        >
                                            <li
                                                class="w-full border-b border-gray-600 sm:border-b-0 sm:border-r"
                                            >
                                                <div
                                                    class="flex items-center ps-3"
                                                >
                                                    <input
                                                        id="vue-checkbox-list"
                                                        type="checkbox"
                                                        v-model="isShowItem"
                                                        value="1"
                                                        name="withItems"
                                                        class="w-4 h-4 text-indigo-600 bg-gray-600 border-gray-500 rounded focus:ring-indigo-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2"
                                                    />
                                                    <label
                                                        for="vue-checkbox-list"
                                                        class="w-full py-3 text-sm font-medium text-gray-300 ms-2"
                                                    >
                                                        پیشاندانی مادەکان لەگەڵ
                                                        وەسڵەکادا</label
                                                    >
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-4 border-t border-gray-600 rounded-b md:p-5"
                                    >
                                        <button
                                            @click.prevent="
                                                exportToPdf();
                                                openPdf = false;
                                            "
                                            type="submit"
                                            class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-indigo-600 hover:bg-indigo-800 focus:ring-indigo-800"
                                        >
                                            داگرتن بە PDF
                                        </button>
                                        <button
                                            @click="openPdf = false"
                                            type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-900"
                                        >
                                            لابردن
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="gap-2 overflow-auto text-base text-center text-gray-300 rounded bg-slate-700"
            >
                <div
                    class="relative h-[62vh] 2xl:h-[68vh] overflow-auto shadow-md sm:rounded-lg"
                >
                    <table class="w-full text-sm text-center text-gray-400">
                        <thead
                            class="sticky top-0 text-sm text-gray-500 uppercase bg-gray-900"
                        >
                            <tr class="truncate">
                                <th scope="col" class="px-2.5 py-3">
                                    ژمــارەی وەســڵ
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    بەکارهێنەر
                                </th>
                                <th scope="col" class="px-6 py-3">کۆی گشتی</th>
                                <th scope="col" class="px-6 py-3">داشکان</th>
                                <th scope="col" class="px-6 py-3">
                                    کـات و بـەروار
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    ژمــارەی خـواردنەکان
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    شێوازی پارەدان
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    کـردارەکــان
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="invoice in invoices"
                                :key="invoice.id"
                                class="w-full border-b border-indigo-500 bg-slate-900 hover:border-y-2 hover:border-rose-800"
                            >
                                <td
                                    scope="row"
                                    class="px-3 py-2 font-medium truncate whitespace-nowrap"
                                >
                                    {{ invoice.id }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-3 py-2 font-medium truncate whitespace-nowrap"
                                >
                                    {{ invoice.addedBy }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ invoice.totalAmount.toLocaleString() }}
                                </td>
                                <td class="px-3 py-2 truncate">
                                    <span class="text-indigo-500">
                                        {{ invoice.discount }}
                                    </span>
                                    د.ع
                                </td>
                                <td class="px-3 py-2 text-center">
                                    {{ invoice.date }}
                                </td>
                                <td class="px-2 py-2 text-center">
                                    <span
                                        class="bg-indigo-400 text-indigo-900 px-1.5 py-0.5 rounded font-semibold"
                                        >{{
                                            invoice?.invoice_items_count
                                        }}</span
                                    >
                                </td>

                                <td class="px-3 py-2">
                                    <h1
                                        class="text-sm text-cyan-500"
                                        v-if="invoice.status === 'cash'"
                                    >
                                        حــازر
                                    </h1>
                                    <h1
                                        v-else-if="invoice.status == 'togo'"
                                        class="text-sm text-yellow-400"
                                    >
                                        ســەفەری
                                    </h1>
                                    <h1
                                        v-else-if="invoice.status == 'delivery'"
                                        class="text-sm text-rose-500"
                                    >
                                        دیـلیڤـەری
                                    </h1>
                                </td>
                                <td class="px-3 py-2 truncate">
                                    <div
                                        class="flex items-center justify-around space-x-2 space-x-reverse"
                                    >
                                        <router-link
                                            :to="{
                                                name: 'invoice.show',
                                                params: { id: invoice.id },
                                            }"
                                            class="font-medium text-indigo-500 hover:underline"
                                            >پیشاندان</router-link
                                        >
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="hasMoreData" class="bg-slate-900">
                                <td colspan="100%" class="p-2 text-center">
                                    <button
                                        @click="loadMore"
                                        class="bg-indigo-600 text-gray-800 hover:bg-indigo-700 hover:text-gray-300 px-8 py-1.5 rounded-lg font-bold"
                                    >
                                        زیــاتــر...
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    isShowItem,
    note,
    loadMore,
    totalSumInvoice,
    totalitems,
    totalSumDiscount,
    status,
    users,
    search,
    reset,
    changeOption,
    dateRange,
    customStartDate,
    exportToPdf,
    customEndDate,
    user_id,
    openPdf,
    showDate,
    getInvoices,
    invoices,
} = useInvoices();

const calculateTotalQuantity = (invoice) => {
    let totalQuantity = 0;
    if (invoice.invoice_items && invoice.invoice_items.length > 0) {
        totalQuantity = invoice.invoice_items.reduce(
            (acc, item) => acc + (item.quantity || 0),
            0
        );
    }
    return totalQuantity;
};

onMounted(() => {
    getInvoices();
});
</script>
