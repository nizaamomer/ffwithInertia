<template>
    <div class="mx-5 my-2">
        <Breadcrumb :items="breadcrumbs" />
        <div class="sm:flex block items-center justify-between mb-4">
            <div
                class="flex items-center space-x-3 rtl:space-x-reverse my-5 sm:my-0 justify-center"
            >
                <InputSearch @searchFunc="searchFunc" v-model.trim="search" />
                <CreateRouteIcon
                    routeName="users/create"
                    label="زیادکردنی بەکارهێنەر"
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
        <div class="relative overflow-x-scroll scroll-smooth rounded-md">
            <table
                v-if="props.users"
                class="w-full text-sm text-left rtl:text-right text-gray-400"
            >
                <thead
                    class="text-xs md:text-base text-center uppercase bg-gray-700 text-gray-400"
                >
                    <tr class="divide-x divide-x-reverse divide-gray-400">
                        <th scope="col" class="px-6 py-3">بەکارهێنەر</th>
                        <th scope="col" class="px-6 py-3">پلــە</th>
                        <th scope="col" class="px-6 py-3">بار</th>
                        <th scope="col" class="px-6 py-3">ژمارەی مۆبایل</th>
                        <th scope="col" class="px-6 py-3">دروست کراوە</th>
                        <th scope="col" class="px-6 py-3">
                            دروست کراوە لەلایەن
                        </th>
                        <th scope="col" class="px-6 py-3">کردارەکان</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="truncate border-b bg-gray-800 border-gray-700 hover:bg-gray-800"
                    >
                        <th
                            scope="row"
                            class="px-6 pr-0 rtl:pr-5 py-2 pt-3 flex items-center space-x-3 rtl:space-x-reverse"
                        >
                            <div class="flex-shrink-0">
                                <img
                                    v-if="user.image"
                                    :src="user.image"
                                    :alt="user.name"
                                    class="w-10 h-10 rounded-full"
                                />
                                <div
                                    v-else
                                    class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gray-600"
                                >
                                    <span
                                        class="font-medium text-normal text-gray-400"
                                       >
                                       
                                       {{ getFirstLetter(user?.name) }}</span
                                    >
                                </div>
                            </div>
                            <div class="flex-1 min-w-0 rtl:pr-2">
                                <p
                                    class="text-sm font-semibold truncate text-gray-200"
                                >
                                    {{ user.name }}
                                </p>
                                <p
                                    class="text-sm font-normal truncate text-gray-400"
                                >
                                    {{ user.email }}
                                </p>
                            </div>
                        </th>

                        <td class="px-6 py-4 capitalize text-center">
                            <span
                                v-if="user?.isAdmin"
                                class="bg-indigo-700 text-indigo-100 rounded-md px-2 py-0.5"
                            >
                                ئەدمین
                            </span>
                            <span
                                v-else
                                class="bg-rose-700 text-rose-100 rounded-md px-2 py-0.5"
                            >
                                کاشێر
                            </span>
                        </td>
                        <td class="px-6 py-4 capitalize text-center">
                            <span
                                v-if="user?.status == 'active'"
                                class="bg-emerald-700 text-emerald-100 rounded-md px-2 py-0.5"
                            >
                                چالاک
                            </span>
                            <span
                                v-if="user?.status == 'inactive'"
                                class="bg-rose-700 text-rose-100 rounded-md px-2 py-0.5"
                            >
                                ناچالەک
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ user.phoneNumber }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{
                                user.created_at?.slice(0, 19).replace("T", "/")
                            }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ user?.addedBy }}
                        </td>

                        <td
                            class="px-6 py-4 text-center flex justify-evenly space-x-4 rtl:space-x-reverse align-middle"
                        >
                            <Link
                                :href="`users/${user.id}/edit`"
                            >
                                <svg
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="sm:w-5 sm:h-5 w-4 h-4 text-indigo-500 cursor-pointer hover:text-indigo-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                    />
                                </svg>
                            </Link>

                            <button @click="showModal[user.id] = true">
                                <svg
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="sm:w-5 sm:h-5 w-4 h-4 text-red-500 cursor-pointer hover:text-red-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                </svg>
                            </button>
                            <!-- Main modal -->
                            <div
                                :id="`modal${user.id}`"
                                v-show="showModal[user.id]"
                                tabindex="-1"
                                aria-hidden="true"
                                class="fixed flex justify-center items-center top-0 left-0 right-0 z-50 w-full pr-8 sm:pr-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                            >
                                <div
                                    class="relative mx-auto md:w-full max-w-md max-h-full"
                                >
                                    <!-- Modal content -->
                                    <div
                                        class="relative rounded-lg shadow bg-gray-900 p-5 text-center items-center"
                                    >
                                        <svg
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="sm:w-16 sm:h-16 w-14 h-14 text-red-500 mx-auto hover:text-red-600"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>
                                        <h1
                                            class="text-indigo-500 text-lg py-2"
                                        >
                                            سڕینەوە!
                                        </h1>
                                        <p class="text-gray-300">
                                            دڵنیای لە سڕینەوەی ئەم بەکارهێنەرە
                                        </p>
                                        <div
                                            class="flex items-center justify-center space-x-5 rtl:space-x-reverse py-5"
                                        >
                                            <button
                                                @click="destroy(user.id)"
                                                class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-rose-600 hover:bg-rose-700 focus:ring-rose-800 rtl:ml-3"
                                            >
                                                بەڵێ بسڕەوە
                                            </button>
                                            <button
                                                @click="
                                                    showModal[user.id] = false
                                                "
                                                type="submit"
                                                class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-800"
                                            >
                                                پاشگەزبوونەوە
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-else class="text-gray-400 text-center mt-24 text-lg">
                هیچبەکارهێنەرێک نەدۆزرایەوە
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, defineProps } from "vue";
import Breadcrumb from "@/Components/breadcrumb.vue";
import InputSearch from "@/Components/inputSearch.vue";
import CreateRouteIcon from "@/Components/createRouteIcon.vue";
import Table from "@/Components/table.vue";
import useSearch from "@/Composables/searchWatch";
import useClearAfterTimeout from "@/Composables/clearFlash";
import useHelperFuncation from "@/Composables/HelperFuncations";
import { Link, router } from "@inertiajs/vue3";
const { getFirstLetter } = useHelperFuncation();
const showModal = ref({});
const breadcrumbs = [{ title: "بەکــارهێنەران", link: "/users" }];
const props = defineProps(["users", "flash", "search"]);
const search = ref(props.search);
const destroy = (id) => {
    router.delete(route("users.destroy", id));
};
const { clearAfterTimeout } = useClearAfterTimeout(props.flash);
clearAfterTimeout();
useSearch(search, "users");
</script>
