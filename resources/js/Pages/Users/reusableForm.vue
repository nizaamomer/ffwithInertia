<template>
    <div class="w-full md:w-8/12 px-5 md:px-0 mx-auto">
        <Breadcrumb :items="breadcrumbs" />
        <div
            class="p-4 border rounded-lg shadow sm:p-8 bg-gray-800 border-gray-700"
        >
            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid md:grid-cols-1 md:gap-6">
                    <div
                        class="relative z-0 w-full mb-1 group text-center sm:text-right"
                    >
                        <div
                            class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full bg-gray-600"
                        >
                            <label for="image" class="cursor-pointer">
                                <input
                                    type="file"
                                    @change="handleImageChange"
                                    name="image"
                                    id="image"
                                    @focus="errors = ''"
                                    class="w-full h-full absolute inset-0 opacity-0 cursor-pointer"
                                    placeholder=" "
                                />
                                <div
                                    v-if="!imageUrl && !user"
                                    id="circleIcon"
                                    class="w-7 h-7 text-emerald-300 bg-center bg-cover bg-no-repeat"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-7 h-7 text-emerald-300"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                        />
                                    </svg>
                                </div>

                                <div
                                    v-if="!user.image && user"
                                    id="circleIcon"
                                    class="w-7 h-7 text-center mt-2 text-indigo-300 bg-center bg-cover bg-no-repeat"
                                >
                                    {{
                                        user.name
                                            ? getFirstLetter(user?.name)
                                            : "وێنە"
                                    }}
                                </div>
                                <img
                                    v-if="imageUrl || (user && user?.image)"
                                    :src="imageUrl || user.image"
                                    :alt="user.name"
                                    class="w-full h-full absolute inset-0 object-cover"
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
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <AnimateInput
                            name="name"
                            type="text"
                            label="ناوی بەکارهێنەر"
                            v-model="user.name"
                            :errors="props.errors.name"
                        />
                        <AnimateInput
                            name="email"
                            type="email"
                            label="ئیمەیڵ"
                            v-model="user.email"
                            :errors="props.errors.email"
                        />
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <label
                                for="roles"
                                class="block mb-2 text-sm font-medium text-gray-400"
                            >
                                باری بەکارهێنەر</label
                            >
                            <select
                                id="roles"
                                name="role"
                                v-model="user.status"
                                @focus="errors = ''"
                                class="border text-sm rounded-lg focus:ring-emerald-500 block w-full p-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-emerald-500"
                            >
                                <option class="bg-emerald-400" value="active">
                                    چالاک
                                </option>
                                <option class="bg-emerald-400" value="inactive">
                                    ناچالاک
                                </option>
                            </select>
                            <div
                                v-if="props.errors.role"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ props.errors.role }}
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label
                                for="roles"
                                class="block mb-2 text-sm font-medium text-gray-400"
                                >پلە دیاری بکە</label
                            >
                            <select
                                id="roles"
                                name="role"
                                v-model="user.isAdmin"
                                @focus="errors = ''"
                                class="border text-sm rounded-lg focus:ring-emerald-500 block w-full p-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-emerald-500"
                            >
                                <option class="bg-emerald-400" value="">
                                    پلە دیاری بکە
                                </option>

                                <option class="bg-emerald-400" value="1">
                                    ئەدمین
                                </option>
                                <option class="bg-emerald-400" value="0">
                                    کاشێر
                                </option>
                            </select>
                            <div
                                v-if="props.errors.isAdmin"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ props.errors.isAdmin }}
                            </div>
                        </div>
                    </div>

                    <div
                        v-show="!props.user"
                        class="grid md:grid-cols-2 md:gap-6"
                    >
                        <AnimateInput
                            name="password"
                            type="password"
                            label="وشەی نهێنی"
                            v-model="user.password"
                            :errors="props.errors.password"
                        />
                        <AnimateInput
                            name="password_confirmation"
                            type="password"
                            label=" دووبەرەکردنەوەی وشەی نهێنی"
                            v-model="user.password_confirmation"
                            :errors="props.errors.password_confirmation"
                        />
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <AnimateInput
                            name="phoneNumber"
                            type="text"
                            label="ژمارەی مۆبایل"
                            v-model="user.phoneNumber"
                            :errors="props.errors.phoneNumber"
                        />
                        <div class="relative z-0 w-full group text-right">
                            <button
                                :disabled="user.processing"
                                v-if="props.user"
                                type="submit"
                                class="text-black font-semibold mt-5 focus:outline-none rounded text-sm w-full px-5 py-2 text-center bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-800"
                            >
                                تازەکردنەوە
                            </button>
                            <button
                                :disabled="user.processing"
                                v-else
                                type="submit"
                                class="text-black font-semibold mt-5 focus:outline-none rounded text-sm w-full px-5 py-2 text-center bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-800"
                            >
                                زیادکردن
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref, watch } from "vue";
import AnimateInput from "@/Components/animateInput.vue";
import { router, useForm } from "@inertiajs/vue3";
import useHandleImage from "@/Composables/HandleImage";
import useHelperFuncation from "@/Composables/HelperFuncations";
const props = defineProps(["user", "errors", "flash"]);
const { getFirstLetter } = useHelperFuncation();
import Breadcrumb from "@/Components/breadcrumb.vue";
const breadcrumbs = [
    { title: "بەکــارهێنەران", link: "/users" },
    {
        title: props.user?.id
            ? "دەستکاریکردنی بەکارهێنەر"
            : "زیادکردنی بەکارهێنەر",
        link: props.user ? `/users/${props.user?.id}/edit` : "/users/create",
    },
];
const user = useForm({
    name: props.user?.name || "",
    email: props.user?.email || "",
    status: props.user?.status || "active",
    phoneNumber: props.user?.phoneNumber || "",
    isAdmin: props.user?.isAdmin || "",
    password: "",
    password_confirmation: "",
    image: props.user?.image || null,
});
const { handleImageChange, imageUrl } = useHandleImage(user);

const submit = () => {
    if (!imageUrl.value) {
        user.image = null;
    }

    if (props.user) {
        console.log(user);
        router.put(route("users.update", props.user.id), props.user, {
            forceFormData: true,
            onSuccess: () => {
                console.log("User created successfully");
            },
            onError: (error) => {
                console.error("Error creating user:", error);
            },
        });
    } else {
        router.post(route("users.store"), user, {
            forceFormData: true,
            onSuccess: () => {
                console.log("User created successfully");
            },
            onError: (error) => {
                console.error("Error creating user:", error);
            },
        });
    }
};
</script>
