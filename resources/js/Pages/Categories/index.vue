<template>
    <div class="mx-5">
        <Breadcrumb :items="breadcrumbs" />
        <div class="sm:flex block items-center justify-between mb-1">
            <div
                class="flex items-center space-x-3 rtl:space-x-reverse my-5 sm:my-0 justify-center"
            >
                <InputSearch @searchFunc="searchFunc" v-model.trim="search" />
                <CreateRouteIcon
                    routeName="category/create"
                    label="زیادکردنی پۆل"
                />
            </div>
            <div
                v-if="flash.message"
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
                <div class="ms-3 text-sm font-medium">
                    {{ flash.message }}
                </div>
            </div>
        </div>
        <div
            class="bg-gray-700 w-full h-[84vh] mx-auto text-gray-300 rounded overflow-auto text-center text-base p-0.5 m-3"
        >
            <div
                class="relative h-[83vh] overflow-y-auto shadow-md sm:rounded-lg"
            >
                <table class="w-full text-sm text-center text-gray-400">
                    <thead
                        class="text-sm text-gray-500 sticky top-0 uppercase bg-gray-900"
                    >
                        <tr>
                            <th scope="col" class="px-3 py-3">ڕیــزبەنــدی</th>
                            <th scope="col" class="px-3 py-3">وێنــە</th>
                            <th scope="col" class="px-3 py-3">
                                جــۆری خــواردن
                            </th>
                            <th scope="col" class="px-3 py-3">بـــار</th>
                            <th scope="col" class="px-3 py-3">کاتی زیادکردن</th>
                            <th scope="col" class="px-3 py-3">
                                زیادکراوە لەلایەن
                            </th>
                            <th scope="col" class="px-3 py-3">دەستکاری کردن</th>
                        </tr>
                    </thead>
                    <draggable
                        v-model="props.categories"
                        tag="tbody"
                        item-key="id"
                        @end="onDragEnd"
                    >
                        <template #item="{ element }">
                            <tr
                                class="bg-slate-900 border-b border-indigo-500 hover:border-y-2 hover:border-rose-800 w-full"
                            >
                                <td scope="row" class="px-3 py-1 text-center">
                                    <button class="drag-handle">
                                        <svg
                                            class="text-gray-400 hover:text-indigo-600 mx-auto"
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
                                                enable-background: new 0 0 64 64;
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
                                    class="px-3 py-1 font-medium whitespace-nowrap text-white"
                                >
                                    <img
                                        :src="element.image"
                                        class="h-20 w-20 object-contain mx-auto"
                                    />
                                </td>
                                <td class="px-3 py-1">
                                    {{ element.name }}
                                </td>
                                <td class="px-3 py-1">
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
                                <td class="px-3 py-1">
                                    {{ element.created_at }}
                                </td>
                                <td class="px-3 py-1">
                                    {{ element.addedBy }}
                                </td>
                                <td class="px-3 py-1">
                                    <router-link
                                        :to="{
                                            name: 'category.edit',
                                            params: { id: element.id },
                                        }"
                                        class="flex justify-center items-center rounded-lg bg-indigo-950 text-indigo-400 w-full h-8"
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
                                        <p class="pr-1.5">دەستکاری</p>
                                    </router-link>
                                </td>
                            </tr>
                        </template>
                    </draggable>
                </table>
                <!-- <rawDisplayer :value="categories" title="Categories" /> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import draggable from "vuedraggable";
import Breadcrumb from "@/components/breadcrumb.vue";
import InputSearch from "@/components/inputSearch.vue";
import CreateRouteIcon from "@/components/createRouteIcon.vue";
import useSearch from "@/Composables/searchWatch";

import { onMounted } from "vue";
const props = defineProps(["categories", "flash", "search"]);
import useClearAfterTimeout from "@/Composables/clearFlash";
import { Link, router } from "@inertiajs/vue3";

const search = ref(props.search);
const breadcrumbs = [{ title: "پۆلــەکان", link: "/categories" }];

onMounted(async () => {
    await getCategories();
});
const onDragEnd = (evt) => {
    const newOrder = categories.value.map((category) => category.id);
    router.put("category/update-order", {
        order: newOrder,
    });
};

const { clearAfterTimeout } = useClearAfterTimeout(props.flash);
clearAfterTimeout();
useSearch(search, "categories");
</script>
