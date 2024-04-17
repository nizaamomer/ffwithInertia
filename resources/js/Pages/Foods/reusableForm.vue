<template>
    <div class="w-full px-5 mx-auto lg:w-5/6 md:px-0">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="bg-slate-800 h-[90vh] py-2 flex flex-col justify-center overflow-auto mx-auto text-gray-300 rounded text-center text-base"
        >
            <form
                class="w-full px-16 py-2 mx-auto bg-indigo-800 rounded shadow-2xl md:max-w-xl"
                @submit.prevent="save"
                enctype="multipart/form-data"
            >
                <div class="w-auto mb-5">
                    <div
                        class="bg-[#1f1d2bb6] rounded-full border-2 w-44 h-44 mx-auto border-dashed border-gray-500 flex flex-col items-center justify-between"
                    >
                        <label
                            class="relative flex items-center justify-center h-full rounded-full cursor-pointer flex-cola"
                        >
                            <img
                                v-if="food.image || imageUrl"
                                :src="
                                    imageUrl
                                        ? imageUrl
                                        : food.image
                                "
                                alt="Preview"
                                class="object-contain w-32 h-32 rounded-full cursor-pointer md:w-44 md:h-44"
                            />
                            <svg
                                v-if="!imageUrl || food.image !== ''"
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
                            <input
                                @change="handleImageChange"
                                @focus="errors = ''"
                                class="absolute w-40 h-full rounded-full opacity-0 cursor-pointer"
                                type="file"
                            />
                        </label>
                    </div>
                    <div v-if="errors.image" class="mt-1 text-sm text-red-400">
                        {{ errors.image[0] }}
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-1 sm:grid-cols-2">
                    <BorderInput
                        name="text"
                        type="text"
                        placeholder="ناوی خواردن"
                        v-model="food.name"
                        :errors="errors.name"
                    />
                    <BorderInput
                        name="price"
                        type="number"
                        placeholder="نرخ: بە ئینگلیزی بنوسە"
                        v-model="food.price"
                        :errors="errors.price"
                    />
                </div>
           
                <div class="mb-5" >
                    <select
                        v-model="food.category_id"
                        class="w-full py-2 text-sm text-gray-400 bg-gray-800 border border-gray-500 border-dashed rounded-lg focus:bg-gray-900 placeholder:text-gray-200 focus:ring-rose-500 focus:border-none"
                    >
                        <option value="">جۆری خواردن دیاری بکە</option>
                        <option
                            v-for="category in categories"
                            :value="category.id"
                            :key="category.id"
                        >
                            <p >
                                {{ category.name }}
                            </p>
                        </option>
                    </select>
                    <div
                        v-if="errors.category_id"
                        class="mt-1 text-sm text-red-400"
                    >
                        {{ errors.category_id[0] }}
                    </div>
                </div>

                <div class="mb-5">
                    <select
                        v-model="food.status"
                        class="w-full py-2 text-sm text-gray-400 bg-gray-800 border border-gray-500 border-dashed rounded-lg focus:bg-gray-900 placeholder:text-gray-200 focus:ring-rose-500 focus:border-none"
                    >
                        <option value="active">چــالاک</option>
                        <option value="inactive">نـا چــالاک</option>
                    </select>
                    <div v-if="errors.status" class="mt-1 text-sm text-red-400">
                        {{ errors.status[0] }}
                    </div>
                </div>

                <div
                    class="relative z-0 items-center block w-full mt-5 mb-2 space-y-4 text-center justify-evenly md:flex md:space-x-4 md:space-y-auto"
                >
                    <button
                        type="submit"
                        class="w-3/4 px-5 py-2 mt-4 text-sm font-medium text-center text-gray-400 bg-gray-900 border rounded shadow-md border-rose-600 hover:bg-gray-950 focus:outline-none sm:w-1/3"
                    >
                        <span v-if="$route.params.id">تازەکردنەوە</span>
                        <span v-else>زیــادکردن</span>
                    </button>
                    <button
                        v-if="$route.params.id"
                        type="button"
                        @click.prevent="destroyFood($route.params.id)"
                        class="w-3/4 px-5 py-2 text-sm font-medium text-center text-gray-300 border border-gray-900 rounded shadow-md bg-rose-700 hover:bg-rose-600 focus:outline-none sm:w-1/3"
                    >
                        سڕیـنـەوە
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import BorderInput from "@/Components/borderInput.vue";
import Breadcrumb from "@/Components/breadcrumb.vue";
import { onMounted, ref } from "vue";
const {
    errors,
    getFood,
    food,
    updateFood,
    storeFood,
    destroyFood,
    imageUrl,
    handleImageChange,
    getCategories,
    categories,
} = useFoods();
const route = useRoute();
const breadcrumbs = [
    { title: "خواردنەکان", link: "/foods" },
    {
        title: route.params.id ? "دەستکاریکردنی خواردن" : "زیادکردنی خواردن",
        link: route.params.id
            ? `/foods/${route.params.id}/edit`
            : "/foods/create",
    },
];
const save = async () => {
    if (route.params.id) {
        await updateFood(route.params.id);
    } else {
        await storeFood();
    }
};
onMounted(() => {
    getCategories();
    if (route.params.id) {
        getFood(route.params.id);
    }
});
</script>
