<template>
    <div class="w-full px-5 mx-auto md:w-8/12 md:px-0">
        <Breadcrumb :items="breadcrumbs" />

        <div
            class="bg-slate-800 w-full mx-auto text-gray-300 rounded text-center text-base py-1 px-3 h-[86vh] flex flex-col justify-center overflow-auto"
        >
            <form
                class="w-full px-8 py-2 mx-auto bg-indigo-800 rounded shadow-2xl md:w-3/4"
                @submit.prevent="save"
                enctype="multipart/form-data"
            >
                <div class="w-auto mb-6">
                    <div
                        class="bg-[#1f1d2bb6] rounded-full border-2 w-32 md:w-44 h-32 md:h-44 mx-auto border-dashed border-gray-500 flex flex-col items-center justify-between"
                    >
                        <label
                            class="relative flex items-center justify-center h-full rounded-full cursor-pointer flex-cola"
                        >
                            <img
                                v-if="category.image || imageUrl"
                                :src="imageUrl ? imageUrl : category.image"
                                alt="Preview"
                                class="object-contain w-32 h-32 rounded-full cursor-pointer md:w-44 md:h-44"
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
                                class="absolute w-40 h-full rounded-full opacity-0 cursor-pointer"
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
                        class="w-full px-2 py-2 text-sm text-gray-400 bg-gray-800 border border-gray-500 border-dashed rounded-lg placeholder:text-gray-200 focus:ring-rose-500 focus:border-none"
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
                    class="relative z-0 items-center block w-full mt-5 mb-2 space-y-4 text-center justify-evenly md:flex md:space-x-4 md:space-y-auto"
                >
                    <button
                        type="submit"
                        :disabled="category.processing"
                        class="w-3/4 px-5 py-2 mt-4 text-sm font-medium text-center text-gray-400 bg-gray-900 border rounded shadow-md border-rose-600 hover:bg-gray-950 focus:outline-none sm:w-1/3"
                    >
                        <span v-if="props.category">تازەکردنەوە</span>
                        <span v-else>زیــادکردن</span>
                    </button>
                    <button
                        v-if="props.category"
                        :disabled="category.processing"
                        type="button"
                        @click.prevent="destroyCategory"
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
import { onMounted, ref } from "vue";
import BorderInput from "@/Components/borderInput.vue";
import useHandleImage from "@/Composables/HandleImage";

import Breadcrumb from "@/Components/breadcrumb.vue";
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
