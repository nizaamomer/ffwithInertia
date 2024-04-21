<template>
    <div class="w-full mx-auto lg:w-4/6">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="bg-slate-800 h-[90vh] flex flex-col justify-center overflow-hidden  text-gray-300 rounded text-center text-base py-1 px-3"
        >
            <div class="relative h-full py-2 space-y-4 overflow-x-auto">
                <div
                    class="grid grid-cols-1 p-4 text-center text-gray-900 bg-gray-300 rounded-md sm:grid-cols-2 gap-x-10 gap-y-6"
                >
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500">نــاوی ئـۆفەر:</p>
                        <span class="font-semibold">{{ offer.name }}</span>
                    </div>
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500">بــاری ئـۆفەر:</p>
                        <span class="font-semibold">
                            <h1
                                class="text-sm text-indigo-600"
                                v-if="offer?.status === 'active'"
                            >
                                چالاک
                            </h1>
                            <h1 class="text-sm text-red-500" v-else>
                                نا چالاک
                            </h1></span
                        >
                    </div>
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500">نــرخی گــشتی:</p>
                        <span class="font-semibold"
                            ><span class="line-through text-rose-600">{{
                                offer.totalAmount
                            }}</span>
                            د.ع</span
                        >
                    </div>
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500">نــرخی ئـۆفەر:</p>
                        <span class="font-semibold"
                            ><span class="text-indigo-600">{{
                                offer.price
                            }}</span>
                            د.ع</span
                        >
                    </div>
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500">زیادکراوە لە لەیەن:</p>
                        <span class="font-semibold">
                            {{ offer?.addedBy }}
                        </span>
                    </div>
                    <div
                        class="flex items-center justify-start space-x-3 space-x-reverse"
                    >
                        <p class="text-gray-500"> کاتی زیادکردن :</p>
                        <span class="font-semibold">
                            {{ offer?.date }}
                        </span>
                    </div>
                    <div
                        class="flex items-center justify-start space-x-5 space-x-reverse col-span-full"
                    >
                        <p class="text-gray-500">تێبینی:</p>
                        <span>{{
                            offer.description
                                ? offer.description
                                : "هیچ تێبینیەک نەنوسراوە..."
                        }}</span>
                    </div>
                </div>

                <h1
                    class="text-lg bg-rose-600 text-gray-800 rounded-tl-md rounded-br-md w-fit mx-auto px-3 py-0.5"
                >
                    خــواردنەکان
                </h1>
                <div
                    class="grid grid-cols-2 gap-2 pb-2 overflow-auto text-base text-center text-gray-900 rounded bg-slate-800 md:grid-cols-3 lg:grid-cols-4"
                >
                    <div
                        v-for="item in offer.items"
                        :key="item.id"
                        class="flex items-center justify-start w-full"
                    >
                        <div
                            class="relative flex flex-col justify-end w-full h-40 cursor-pointer"
                        >
                            <img
                                :src="item.food.image"
                                class="absolute top-0 left-0 right-0 z-50 object-cover h-24 mx-auto rounded-full"
                            />
                            <div
                                class="relative w-full pt-16 space-y-1 text-center bg-gray-300 rounded-lg shadow-2xl h-4/5"
                            >
                                <p
                                    class="absolute top-0 left-0 px-2 py-1 text-sm font-semibold text-gray-200 rounded-tl rounded-br shadow-lg bg-rose-500"
                                >
                                    {{ item.quantity }}X
                                </p>
                                <h1 class="text-sm font-bold">
                                    {{ item.food.name }}
                                </h1>
                                <h1
                                    class="text-base font-semibold text-indigo-500"
                                >
                                    {{ item.food.price }} د.ع
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>

import { onMounted, ref } from "vue";
import Breadcrumb from "@/Components/breadcrumb.vue";
const route = useRoute();
const breadcrumbs = [
    { title: "ئۆفەرەکان", link: "/offers" },
    {
        title: "وردەکاری ئۆفەر",
        link: `/offer/${route.params.id}/show`
    },
];
const { showOffer, offer } = useOffers();
onMounted(() => {
    showOffer(route.params.id);
});
</script>
