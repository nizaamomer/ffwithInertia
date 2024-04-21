<template>
    <div class="w-full mx-auto md:w-11/12">
        <Breadcrumb :items="breadcrumbs" />
        <div class="items-center justify-between block mb-1 sm:flex">
            <div
                class="flex items-center justify-center my-5 space-x-3 rtl:space-x-reverse sm:my-0"
            >
                <InputSearch @searchFunc="searchFunc" v-model.trim="search" />
                <CreateRouteIcon href="offer.create" label="زیادکردنی ئۆفەر" />
            </div>
            <div
                v-if="message"
                id="alert-3"
                class="flex items-center p-2.5 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert"
            >
                <svg
                    class="flex-shrink-0 w-4 h-4"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                    />
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-sm font-medium ms-3">
                    {{ message }}
                </div>
            </div>
        </div>
        <div
            class="bg-slate-700 w-full h-[84vh] mx-auto text-gray-300 rounded overflow-hidden text-center text-base p-2 m-3"
        >
            <div
                class="gap-2 overflow-auto text-base text-center text-gray-300 rounded bg-slate-700 sm:pb-3"
            >
                <div
                    class="relative h-[83vh] overflow-x-auto shadow-md sm:rounded-lg"
                >
                    <table
                        class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="sticky top-0 text-sm text-gray-500 uppercase bg-gray-900"
                        >
                            <tr class="truncate">
                                <th scope="col" class="px-3 py-3">
                                    ڕیــزبەنــدی
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    نــاوی ئــۆفــەر
                                </th>

                                <th scope="col" class="px-3 py-3">
                                    نـرخی ئــۆفــەر
                                </th>

                                <th scope="col" class="px-3 py-3">
                                    ژمــارەی خواردن
                                </th>
                                <th scope="col" class="px-3 py-3">بـــار</th>
                                <th scope="col" class="px-3 py-3">
                                    کـردارەکــان
                                </th>
                            </tr>
                        </thead>
                        <draggable
                            v-model="offers"
                            tag="tbody"
                            item-key="id"
                            @end="onDragEnd"
                        >
                            <template #item="{ element }">
                                <tr
                                    class="w-full border-b border-indigo-500 bg-slate-900 hover:border-y-2 hover:border-rose-800"
                                >
                                    <td
                                        scope="row"
                                        class="px-3 py-2 text-center"
                                    >
                                        <button class="drag-handle">
                                            <svg
                                                class="mx-auto text-gray-400 hover:text-indigo-600"
                                                fill="currentColor"
                                                width="32"
                                                height="32"
                                                version="1.1"
                                                id="lni_lni-line-double"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                x="0px"
                                                y="0px"
                                                viewBox="0 0 64 64"
                                                style="
                                                    enable-background: new 0 0
                                                        64 64;
                                                "
                                                xml:space="preserve"
                                            >
                                                <g>
                                                    <path
                                                        d="M4,26.6h56c1.2,0,2.3-1,2.3-2.3s-1-2.3-2.3-2.3H4c-1.2,0-2.3,1-2.3,2.3S2.8,26.6,4,26.6z"
                                                    />
                                                    <path
                                                        d="M60,37.4H4c-1.2,0-2.3,1-2.3,2.3s1,2.3,2.3,2.3H56c1.2,0,2.3-1,2.3-2.3S61.2,37.4,60,37.4z"
                                                    />
                                                </g>
                                            </svg>
                                        </button>
                                    </td>
                                    <td
                                        scope="row"
                                        class="px-3 py-2 font-medium truncate whitespace-nowrap"
                                    >
                                        {{ element.name }}
                                    </td>

                                    <td class="px-3 py-2 truncate">
                                        <span class="text-indigo-500">
                                            {{ element?.price }}
                                        </span>
                                        د.ع
                                    </td>

                                    <td class="px-3 py-2">
                                        {{ element?.itemsLength }}
                                    </td>
                                    <td class="px-3 py-2">
                                        <h1
                                            class="text-sm text-indigo-500"
                                            v-if="element.status === 'active'"
                                        >
                                            چالاک
                                        </h1>
                                        <h1 class="text-sm text-red-500" v-else>
                                            نا چالاک
                                        </h1>
                                    </td>
                                    <td class="px-3 py-2 truncate">
                                        <div
                                            class="flex items-center justify-around space-x-2 space-x-reverse"
                                        >
                                            <router-link
                                                :to="{
                                                    name: 'offer.show',
                                                    params: { id: element.id },
                                                }"
                                                class="text-emerald-500"
                                            >
                                                <svg
                                                    width="20"
                                                    height="20"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M11.984 5.25c-3.653 0-7.401 2.115-10.351 6.344a.75.75 0 0 0-.013.833c2.267 3.548 5.964 6.323 10.364 6.323 4.352 0 8.125-2.783 10.397-6.34a.757.757 0 0 0 0-.819C20.104 8.076 16.303 5.25 11.984 5.25Z"
                                                    ></path>
                                                    <path
                                                        d="M12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                                    ></path>
                                                </svg>
                                            </router-link>
                                            <router-link
                                                :to="{
                                                    name: 'offer.edit',
                                                    params: { id: element.id },
                                                }"
                                                class="text-indigo-500"
                                            >
                                                <svg
                                                    width="20"
                                                    height="20"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M6.414 16.002 16.556 5.86l-1.414-1.414L5 14.588v1.414h1.414Zm.829 2H3v-4.243L14.435 2.324a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 18.002Zm-4.243 2h18v2H3v-2Z"
                                                    ></path>
                                                </svg>
                                            </router-link>
                                            <button
                                                @click="
                                                    toggleShowDelete(element.id)
                                                "
                                                :data-modal-target="`deletemodal${element.id}`"
                                                :data-modal-toggle="`deletemodal${element.id}`"
                                            >
                                                <svg
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-4 h-4 text-red-500 cursor-pointer sm:w-5 sm:h-5 hover:text-red-600"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <!-- Main modal -->
                                    <div
                                        v-if="showDeleteModal[element.id]"
                                        :id="`deletemodal${element.id}`"
                                        tabindex="-1"
                                        aria-hidden="true"
                                        class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[60] flex justify-center items-center"
                                    >
                                        <div
                                            class="relative w-full max-w-md max-h-full p-4"
                                        >
                                            <!-- Modal content -->
                                            {{ element.id }}
                                            <div
                                                class="relative items-center p-5 text-center bg-gray-800 rounded-lg shadow"
                                            >
                                                <svg
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="mx-auto text-red-500 sm:w-20 sm:h-20 w-14 h-14 hover:text-red-600"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                    />
                                                </svg>
                                                <h1
                                                    class="py-2 text-lg text-indigo-500"
                                                >
                                                    سڕیــنەوە!
                                                </h1>
                                                <p class="dark:text-gray-300">
                                                    دڵنیایی لە سڕیــنەوەی ئەم
                                                    ئۆفەرە ؟
                                                </p>
                                                <div
                                                    class="flex items-center justify-center py-5 space-x-5 rtl:space-x-reverse"
                                                >
                                                    <button
                                                        @click="
                                                            destroy(element.id);
                                                            toggleShowDelete(
                                                                element.id
                                                            );
                                                        "
                                                        :data-modal-hide="`deletemodal${element.id}`"
                                                        type="submit"
                                                        class="text-gray-300 bg-rose-700 hover:bg-rose-800 hover:ring-4 hover:ring-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-900 rounded-lg text-sm font-medium px-5 py-2.5 focus:z-10"
                                                    >
                                                        بەڵــێ بسڕەوە!
                                                    </button>

                                                    <button
                                                        @click="
                                                            toggleShowDelete(
                                                                element.id
                                                            )
                                                        "
                                                        :data-modal-hide="`deletemodal${element.id}`"
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
                            </template>
                        </draggable>
                    </table>
                    <rawDisplayer :value="offers" title="Offers" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import draggable from "vuedraggable";
import Breadcrumb from "@/Components/breadcrumb.vue";
const breadcrumbs = [{ title: "ئۆفەرەکان", link: "/offers" }];
import InputSearch from "@/Components/inputSearch.vue";
import CreateRouteIcon from "@/Components/createRouteIcon.vue";
import { onBeforeMount, ref } from "vue";
const showDeleteModal = ref({});
const toggleShowDelete = (itemId) => {
    showDeleteModal.value[itemId] = !showDeleteModal.value[itemId];
};
const {
    search,
    searchFunc,
    message,
    getOffers,
    offers,
    updateOfferOrder,
    destroy,
} = useOffers();
onBeforeMount(async () => {
    await getOffers();
});
const onDragEnd = (evt) => {
    const newOrder = offers.value.map((offer) => offer.id);
    updateOfferOrder(newOrder);
};
</script>
