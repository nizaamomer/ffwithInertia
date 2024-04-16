<template>
    <div class="w-full md:w-8/12 px-5 md:px-0 mx-auto">
        <Breadcrumb :items="breadcrumbs" />

        <div
            class="bg-slate-800 w-full mx-auto text-gray-300 rounded text-center text-base py-1 px-3 h-[86vh] flex flex-col justify-center overflow-auto"
        >
            <form
                class="md:w-3/4 w-full mx-auto shadow-2xl px-8 py-2 rounded bg-indigo-800"
                @submit.prevent="save"
                enctype="multipart/form-data"
            >
                <div class="mb-6 w-auto">
                    <div
                        class="bg-[#1f1d2bb6] rounded-full border-2 w-32 md:w-44 h-32 md:h-44 mx-auto border-dashed border-gray-500 flex flex-col items-center justify-between"
                    >
                        <label
                            class="flex flex-cola items-center cursor-pointer relative rounded-full justify-center h-full"
                        >
                            <img
                                v-if="category.image || imageUrl"
                                :src="imageUrl ? imageUrl : category.image"
                                alt="Preview"
                                class="object-contain cursor-pointer w-32 md:w-44 h-32 md:h-44 rounded-full"
                            />
                            <svg
                                v-if="!imageUrl"
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
                                @focus="props.errors = ''"
                                class="opacity-0 rounded-full cursor-pointer h-full w-40 absolute"
                                type="file"
                            />
                        </label>
                    </div>
                    <div
                        v-if="props.errors.image"
                        class="mt-1 text-sm text-red-400"
                    >
                        {{ props.errors.image }}
                    </div>
                </div>
                <BorderInput
                    name="text"
                    type="text"
                    placeholder=" جۆری خواردن"
                    v-model="category.name"
                    :errors="props.errors.name"
                />

                <div class="mb-6">
                    <select
                        v-model="category.status"
                        class="w-full py-2 bg-gray-800 px-2 border-dashed border-gray-500 border placeholder:text-gray-200 text-gray-400 text-sm rounded-lg focus:ring-rose-500 focus:border-none"
                    >
                        <option value="active">چـالاک</option>
                        <option value="inactive">نـا چــالاک</option>
                    </select>
                    <div
                        v-if="props.errors.status"
                        class="mt-1 text-sm text-red-400"
                    >
                        {{ props.errors.status }}
                    </div>
                </div>

                <div
                    class="relative z-0 mb-2 text-center justify-evenly items-center block md:flex md:space-x-4 w-full mt-5 space-y-4 md:space-y-auto"
                >
                    <button
                        type="submit"
                        :disabled="category.processing"
                        class="bg-gray-900 border border-rose-600 text-gray-400 hover:bg-gray-950 mt-4 shadow-md focus:outline-none font-medium rounded text-sm sm:w-1/3 w-3/4 px-5 py-2 text-center"
                    >
                        <span v-if="props.category">تازەکردنەوە</span>
                        <span v-else>زیــادکردن</span>
                    </button>
                    <button
                        v-if="props.category"
                        :disabled="category.processing"
                        type="button"
                        @click.prevent="destroyCategory"
                        class="bg-rose-700 border border-gray-900 text-gray-300 hover:bg-rose-600 shadow-md focus:outline-none font-medium rounded text-sm sm:w-1/3 w-3/4 px-5 py-2 text-center"
                    >
                        سڕیـنـەوە
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import useCategories from "@/composables/categories";
import { onMounted, ref } from "vue";
import BorderInput from "@/components/borderInput.vue";
import useHandleImage from "@/Composables/HandleImage";

import Breadcrumb from "@/components/breadcrumb.vue";
import { router } from "@inertiajs/vue3";
const props = defineProps(["category", "errors", "flash"]);

const breadcrumbs = [
    { title: "پۆلــەکان", link: "/categories" },
    {
        title: props.category ? "دەستکاریکردنی پۆل" : "زیادکردنی پۆل",
        link: props.category
            ? `/category/${props.category.id}/edit`
            : "/category/create",
    },
];

const category = useForm({
    name: props.user?.name || "",
    status: props.user?.status || "active",
    image: props.user?.image || null,
});
const { handleImageChange, imageUrl } = useHandleImage(user);

const destroyCategory = async () => {
    router.delete("/categories/" + props.category.id);
};

const save = () => {
    if (!imageUrl.value) {
        category.image = null;
    }

    if (props.category) {
        console.log(category);
        router.put(
            route("categories.update", props.category.id),
            props.category,
            {
                forceFormData: true,
                onSuccess: () => {
                    console.log("User created successfully");
                },
                onError: (error) => {
                    console.error("Error creating user:", error);
                },
            }
        );
    } else {
        router.post(route("categories.store"), category, {
            forceFormData: true,
            onSuccess: () => {
                console.log("category created successfully");
            },
            onError: (error) => {
                console.error("Error creating category:", error);
            },
        });
    }
};
onMounted(() => {
    if (route.params.id) {
        getCategory(route.params.id);
    }
});
</script>
