<template>
  <div class="md:w-11/12 mx-auto  w-full">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="bg-slate-700 w-full h-[90vh]  text-gray-300 rounded overflow-hidden text-center text-base p-2 m-0.5"
        >
            <div
                class="flex items-center relative flex-wrap gap-y-2 justify-between min-w-full pb-3"
            >
              
                <div
                    class="flex w-fit space-x-2 space-x-reverse items-center relative justify-between"
                >
                    
                    <InputSearch
                        @searchFunc="searchFunc"
                        v-model.trim="search"
                    />
                </div>
            </div>
            <div
                class="bg-slate-700 sm:pb-3 text-gray-300 rounded text-center text-base gap-2 overflow-auto"
            >
                <div
                    class="relative h-[89vh] overflow-x-auto shadow-md sm:rounded-lg"
                >
                    <table
                        class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-sm text-gray-500 sticky top-0 uppercase bg-gray-900"
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
                                class="bg-slate-900 border-b border-indigo-500 hover:border-y-2 hover:border-rose-800 w-full"
                            >
                            <td
                                    scope="row"
                                    class="px-3 py-2 truncate font-medium whitespace-nowrap"
                                >
                                    {{ invoice.id }}
                                </td>
                                <td
                                
                                    scope="row"
                                    class="px-3 py-2 truncate font-medium whitespace-nowrap"
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
                                        >
                                            {{ invoice.itemsLength }}
                                        </span
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
                                        class="flex justify-around items-center space-x-2 space-x-reverse"
                                    >
                                        <router-link
                                            :to="{
                                                name: 'invoice.show',
                                                params: { id: invoice.id },
                                            }"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >پیشاندان</router-link
                                        >
                                        <!-- <button
                                            :data-modal-target="`deletemodal${invoice.id}`"
                                            :data-modal-toggle="`deletemodal${invoice.id}`"
                                        >
                                            <svg
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="sm:w-5 sm:h-5 w-4 h-4 text-red-500 cursor-pointer hover:text-red-600"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                />
                                            </svg>
                                        </button> -->
                                    </div>
                                </td>
                                <!-- Main modal -->
                                <div
                                    :id="`deletemodal${invoice.id}`"
                                    tabindex="-1"
                                    aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full pr-8 sm:pr-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                                >
                                    <div
                                        class="relative sm:w-full w-3/4 max-w-md max-h-full"
                                    >
                                        <!-- Modal content -->
                                        {{ invoice.id }}
                                        <div
                                            class="relative rounded-lg shadow bg-gray-800 p-5 text-center items-center"
                                        >
                                            <svg
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="sm:w-20 sm:h-20 w-14 h-14 text-red-500 mx-auto hover:text-red-600"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                />
                                            </svg>
                                            <h1
                                                class="text-indigo-500 text-lg py-2"
                                            >
                                                سڕیــنەوە!
                                            </h1>
                                            <p class="dark:text-gray-300">
                                                دڵنیایی لە سڕیــنەوەی ئەم خەرجیە
                                                ؟
                                            </p>
                                            <div
                                                class="flex items-center justify-center space-x-5 rtl:space-x-reverse py-5"
                                            >
                                                <button
                                                    @click="
                                                        deleteExpense(
                                                            invoice.id
                                                        )
                                                    "
                                                    :data-modal-hide="`deletemodal${invoice.id}`"
                                                    type="submit"
                                                    class="text-gray-300 bg-rose-700 hover:bg-rose-800 hover:ring-4 hover:ring-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-900 rounded-lg text-sm font-medium px-5 py-2.5 focus:z-10"
                                                >
                                                    بەڵــێ بسڕەوە!
                                                </button>

                                                <button
                                                    :data-modal-hide="`deletemodal${invoice.id}`"
                                                    type="submit"
                                                    class="text-white bg-gray-700 hover:bg-gray-900 hover:ring-2 hover:ring-rose-700 focus:ring-2 focus:outline-none focus:ring-rose-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                >
                                                    پاشگەزبوونەوە
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            <tr v-if="hasMoreData" class="bg-slate-900">
                                <td colspan="100%" class="p-2 text-center">
                                    <button
                                        @click="loadData"
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
import useInvoices from "@/composables/invoices";
import { onMounted, ref, watch } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrumb from "@/components/breadcrumb.vue";
import InputSearch from "@/components/inputSearch.vue";

const breadcrumbs = [{ title: "وەسڵەکان", link: "/invoices" }];

const {
    getInvoices,
    invoices,
    search,searchFunc,errors,error,
    destroyInvoice,
    message,
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
})
const deleteInvoice = async (id) => {
    await destroyInvoice(id);
};
</script>
