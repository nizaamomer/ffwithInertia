<template>
    <div class="w-full lg:w-4/6   mx-auto">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="bg-slate-800 h-[90vh] flex flex-col justify-center overflow-hidden  text-gray-300 rounded text-center text-base py-1 px-3"
        >
            <div class="relative h-full overflow-x-auto space-y-4 py-2">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 text-gray-900 gap-x-10 gap-y-6 bg-gray-300 p-4 rounded-md text-center"
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
                            ><span class="text-rose-600 line-through">{{
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
                        class="col-span-full flex items-center justify-start space-x-5 space-x-reverse"
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
                    class="bg-slate-800 text-gray-900 pb-2 rounded grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 text-center text-base gap-2 overflow-auto"
                >
                    <div
                        v-for="item in offer.items"
                        :key="item.id"
                        class="flex items-center justify-start w-full"
                    >
                        <div
                            class="h-40 w-full relative flex flex-col justify-end cursor-pointer"
                        >
                            <img
                                :src="item.food.image"
                                class="h-24 object-cover absolute rounded-full left-0 right-0 mx-auto top-0 z-50"
                            />
                            <div
                                class="h-4/5 w-full relative bg-gray-300 rounded-lg pt-16 text-center space-y-1 shadow-2xl"
                            >
                                <p
                                    class="absolute top-0 left-0 bg-rose-500 shadow-lg font-semibold text-gray-200 px-2 py-1 rounded-br rounded-tl text-sm"
                                >
                                    {{ item.quantity }}X
                                </p>
                                <h1 class="text-sm font-bold">
                                    {{ item.food.name }}
                                </h1>
                                <h1
                                    class="text-base text-indigo-500 font-semibold"
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
import { useRoute } from "vue-router";
import { onMounted, ref } from "vue";
import useOffers from "@/composables/offers";
import Breadcrumb from "@/components/breadcrumb.vue";
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
