<template>
    <div
        class="bg-slate-700 h-full w-full rounded-tr-md rounded-br-md mt-2 mx-auto flex flex-col justify-center items-center overflow-y-auto text-right"
    >
        <div
            v-if="message"
            id="toast-success"
            dir="ltr"
            class="absolute left-5 top-10 z-50 w-1/4 flex items-center p-4 mb-4 text-gray-500 bg-slate-900 rounded-lg shadow"
            role="alert"
        >
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-gray-800 rounded-lg"
            >
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
                    />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 rtl:mr-3 text-sm font-normal">{{ message }}</div>
            <button
                type="button"
                @click="message = ''"
                class="ml-auto -mx-1.5 -my-1.5 bg-gray-800 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
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
            </button>
        </div>
        <div
            v-if="error"
            id="toast-error"
            dir="ltr"
            class="absolute left-5 top-10 z-50 w-1/4 flex items-center justify-between p-4 mb-4 text-gray-500 bg-gray-950 rounded-lg shadow"
            role="alert"
        >
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-gray-800 rounded-lg"
            >
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
                    />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 rtl:mr-3 text-sm font-normal text-right">
                {{ error }}
            </div>
            <button
                type="button"
                @click="error = ''"
                class="ml-auto -mx-1.5 -my-1.5 bg-gray-800 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-error"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
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
            </button>
        </div>

        <div
            class="md:w-11/12 w-full flex flex-col justify-start mx-auto item-start px-5"
        >
            <div
                class="mx-auto w-full md:w-11/12 grid grid-cols-1 px-5 py-3 sm:grid-cols-2 gap-10 bg-slate-900 text-gray-200 rounded-lg shadow-md sm:p-8"
            >
                <form
                    @submit.prevent="submitForm((num = 'form1'))"
                    enctype="multipart/form-data"
                    class="text-right w-full space-y-5"
                >
                    <div class="space-y-2">
                        <div
                            class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full"
                        >
                            <label for="image" class="cursor-pointer">
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="w-full h-full absolute inset-0 opacity-0 cursor-pointer"
                                    @change="handleImageChange"
                                    @focus="errors = ''"
                                />
                                <div
                                    v-if="!user?.image"
                                    id="circleIcon"
                                    class="w-7 h-7 text-indigo-300 bg-center bg-cover bg-no-repeat"
                                >
                                    <!-- {{ getFirstLetter(user?.name) }} -->
                                </div>
                                <img
                                    v-if="imageUrl || (user && user?.image)"
                                    :src="imageUrl || user.image"
                                    alt="Preview"
                                    class="w-full h-full absolute inset-0 object-cover"
                                />
                            </label>
                        </div>
                        <div class="text-yellow-400 text-sm mt-1">
                            گرتە بک بۆ هــەڵبژاردنی وێنەیەکی نوێ
                        </div>
                        <div
                            v-if="errors.image"
                            class="mt-1 text-sm text-red-400"
                        >
                            {{ errors.image[0] }}
                        </div>
                    </div>

                    <Input
                        name="name"
                        type="text"
                        label="نــاو:"
                        placeholder="نــاوەکەت..."
                        v-model="user.name"
                        :errors="errors.name"
                    />
                    <Input
                        name="email"
                        type="email"
                        label="ئــیمێڵ:"
                        placeholder="ئــیمێڵەکەت..."
                        v-model="user.email"
                        :errors="errors.email"
                    />
                    <Input
                        name="phoneNumber"
                        type="text"
                        label="ژمــــارەکەت:"
                        placeholder="ژمــارەکەت..."
                        v-model="user.phoneNumber"
                        :errors="errors.phoneNumber"
                    />

                    <div>
                        <button
                            type="submit"
                            class="py-2.5 mt-4 bg-rose-800 w-full hover:bg-rose-900 cursor-pointer px-10 text-sm font-medium whitespace-nowrap rtl:ml-2 text-white focus:outline-none rounded-lg"
                        >
                            تــــازەکـردنــەوە
                        </button>
                    </div>
                </form>

                <form
                    @submit.prevent="submitForm(form)"
                    class="text-right w-full space-y-5"
                >
                    <h1 class="my-4 mb-10 text-yellow-500 text-lg">
                        گــۆڕینی وشــەی نهێنی
                    </h1>
                    <input type="hidden" name="num" value="form2" />

                    <Input
                        name="current_password"
                        type="password"
                        label="وشــەی نهێنی ئێستا:"
                        placeholder="..."
                        v-model="form.current_password"
                        :errors="errors.current_password"
                    />

                    <Input
                        name="password"
                        type="password"
                        label="وشــەی نهێنی نــوێ:"
                        placeholder="..."
                        v-model="form.password"
                        :errors="errors.password"
                    />

                    <Input
                        name="password_confirmation"
                        type="password"
                        label="دووبــارە وشەی نهێنی:"
                        placeholder="..."
                        v-model="form.password_confirmation"
                        :errors="errors.password_confirmation"
                    />

                    <div>
                        <button
                            type="submit"
                            class="py-2.5 mt-4 bg-emerald-800 w-full hover:bg-emerald-900 cursor-pointer px-10 text-sm font-medium whitespace-nowrap rtl:ml-2 text-white focus:outline-none rounded-lg"
                        >
                            تــــازەکـردنــەوەی تێپەڕە وشــە
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <router-link
                            :to="{ name: 'forget.password' }"
                            class="text-sm text-red-500 hover:underline"
                        >
                            وشــەی نهێنییت لەبیرکردووە؟
                        </router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, reactive, watch, onMounted } from "vue";
import Input from "@/Components/input.vue";
const imageUrl = ref(null);
defineProps(['user'])
const form = reactive({
    current_password: "",
    password: "",
    password_confirmation: "",
    num: "form2",
});
const submitForm = async (form) => {
    if (form === "form1") {
        const formData = new FormData();
        formData.append("name", user.value.name);
        formData.append("email", user.value.email);
        formData.append("phoneNumber", user.value.phoneNumber);
        formData.append("num", "form1");
        if (user.value.image instanceof File) {
            formData.append("image", user.value.image);
        }
        await UpdateProfile(formData);
    } else if (form.num === "form2") {
        await UpdateProfile(form);
    }
};

const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        user.value.image = file;
        imageUrl.value = URL.createObjectURL(file);
    } else {
        imageUrl.value = null;
        user.value.image = null;
    }
};
</script>
