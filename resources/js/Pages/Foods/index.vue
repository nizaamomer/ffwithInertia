<template>
    <div class="mx-5">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="bg-slate-700 w-full h-[91vh] mx-auto text-gray-300 rounded overflow-hidden text-center text-base p-2 m-0.5"
        >
            <div
                class="items-center justify-between block min-w-full pb-3 space-y-2 lg:flex lg:space-y-0"
            >
                <div class="flex items-center justify-start">
                    <button
                        class="px-3 py-1 ml-1.5 border-b-2 cursor-pointer border-slate-950 rounded bg-rose-800 hover:bg-rose-900"
                        @click="getFoodByCategory('all')"
                    >
                        هەموو
                    </button>
                    <!-- <button
                        class="px-3 py-1 ml-1.5 border-b-2 cursor-pointer border-slate-950 rounded bg-teal-700 hover:bg-teal-800"
                        @click="getFoodByCategory('drinks')"
                    >
                        خواردنەوەکان
                    </button> -->
                    <div class="flex items-center justify-start overflow-auto">
                        <button
                            type="button"
                            class="px-3 py-1 ml-1 bg-gray-900 border-b-2 border-red-500 rounded cursor-pointer hover:bg-gray-950"
                            v-for="category in categories"
                            :key="category.id"
                            @click="getFoodByCategory(category.id)"
                        >
                            {{ category.name }}
                        </button>
                    </div>
                </div>
                <div class="w-full lg:w-auto">
                    <InputSearch
                        @searchFunc="searchFunc"
                        v-model.trim="search"
                    />
                </div>
            </div>

            <div
                class="gap-2 overflow-auto text-base text-center text-gray-300 rounded bg-slate-700 sm:pb-3"
            >
                <div class="relative h-[74vh] md:h-[82vh] overflow-x-auto">
                    <div
                        class="grid grid-cols-2 gap-2 pb-2 overflow-auto text-base text-center text-gray-300 rounded bg-slate-700 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
                    >
                        <router-link
                            v-if="showAll"
                            :to="{ name: 'food.create' }"
                            class="flex flex-col items-center justify-between h-64 border-2 border-gray-500 border-dashed rounded-lg bg-slate-950"
                        >
                            <div
                                class="flex flex-col items-center justify-center h-full text-indigo-600"
                            >
                                <svg
                                    width="32"
                                    height="32"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M20 12H4"></path>
                                    <path d="M12 20V4"></path>
                                </svg>
                                <h1 class="text-xl">زیادکردن</h1>
                            </div>
                        </router-link>
                        <div
                            v-for="food in foods"
                            :key="food"
                            class="bg-slate-950 rounded-lg border-[1.8px] h-64 border-gray-600 flex flex-col items-center justify-start"
                        >
                            <div
                                class="flex flex-col items-center justify-center h-full space-y-2"
                            >
                                <img
                                    v-if="food.image"
                                    :src="food.image"
                                    class="object-contain w-24 h-24 rounded-full cursor-pointer"
                                />
                                <h1 class="text-xl">{{ food.name }}</h1>
                                <h1 class="text-lg">{{ food.price }} د.ع</h1>
                                <h1
                                    class="text-sm text-indigo-500"
                                    v-if="food.status == 'active'"
                                >
                                    چالاک
                                </h1>
                                <h1
                                    class="text-sm text-red-500"
                                    v-if="food.status == 'inactive'"
                                >
                                    نا چالاک
                                </h1>
                            </div>
                            <router-link
                                :to="{
                                    name: 'food.edit',
                                    params: { id: food.id },
                                }"
                                class="flex items-center justify-center w-full h-8 text-indigo-400 rounded-b-lg bg-indigo-950"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputSearch from "@/Components/inputSearch.vue";
import Breadcrumb from "@/Components/breadcrumb.vue";
const breadcrumbs = [{ title: "خواردنەکان", link: "/foods" }];

    // getFoods,
    // foods,
    // message,
    // search,
    // searchFunc,
    // getFoodByCategory,
    // showAll,


</script>
