<template>
    <div class="relative overflow-x-scroll scroll-smooth rounded-md">
            <table
                v-if="data"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-center text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr class="divide-x divide-gray-400">
                        <th v-for="column in columns" :key="column.key">{{ column.label }}</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr
                    v-for="item in data" :key="item.id"
                        class="bg-white truncate border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800"
                    >
                    <th
                            scope="row"
                            class="px-6 pr-0 rtl:pr-5 py-2 pt-3 flex items-center space-x-3 rtl:space-x-reverse"
                        >
                            <div class="flex-shrink-0">
                                <img
                                    v-if="item.image"
                                    :src="`${appUrl}/item_images/${item.image}`"
                                    :alt="item.name"
                                    class="w-10 h-10 rounded-full"
                                />
                                <div
                                    v-else
                                    class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-300 rounded-full dark:bg-gray-600"
                                >
                                    <span
                                        class="font-medium text-normal text-gray-600 dark:text-gray-400"
                                        >{{ getFirstLetter(item.name) }}</span
                                    >
                                </div>
                            </div>
                            <div class="flex-1 min-w-0 rtl:pr-2">
                                <p
                                    class="text-sm font-semibold text-gray-900 truncate dark:text-gray-200"
                                >
                                    {{ item.name }}
                                </p>
                                <p
                                    class="text-sm font-normal text-gray-500 truncate dark:text-gray-400"
                                >
                                    {{ item.email }}
                                </p>
                            </div>
                        </th>
                        <td  v-for="column in columns" :key="column.key" class="px-6 py-4 capitalize text-center">
                                {{ item[column.key] }}
                            <!-- <div v-for="role in user.roles" :key="role.id">
                              
                            </div> -->
                        </td>
                      
                        <td
                            class="px-6 py-4 text-center flex justify-evenly space-x-4 rtl:space-x-reverse align-middle"
                        >
                            <!-- v-if="hasPermissionTo(['User Show'])" -->
                            <router-link
                                :to="{
                                    name: 'user.show',
                                    params: { id: item.id },
                                }"
                            >
                                <svg
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="sm:w-5 sm:h-5 w-4 h-4 rtl:ml-3 text-green-400 cursor-pointer hover:text-green-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </router-link>

                            <router-link
                                :to="{
                                    name: 'user.edit',
                                    params: { id: item.id },
                                }"
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
                            </router-link>

                            <button
                                :data-modal-target="`modal${item.id}`"
                                :data-modal-toggle="`modal${item.id}`"
                            >
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
                                :id="`modal${item.id}`"
                                tabindex="-1"
                                aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full pr-8 sm:pr-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                            >
                                <div
                                    class="relative sm:w-full w-3/4 max-w-md max-h-full"
                                >
                                    <!-- Modal content -->
                                    <div
                                        class="relative bg-white rounded-lg shadow dark:bg-gray-800 p-5 text-center items-center"
                                    >
                                        <svg
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="sm:w-20 sm:h-20 w-14 h-14 text-red-500 mx-auto hover:text-red-600"
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
                                            Delete!
                                        </h1>
                                        <p class="dark:text-gray-300">
                                            deleteUser
                                        </p>
                                        <div
                                            class="flex items-center justify-center space-x-5 rtl:space-x-reverse py-5"
                                        >
                                            <button
                                                @click="deleteUser(item.id)"
                                                :data-modal-hide="`modal${item.id}`"
                                                class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 rtl:ml-3"
                                            >
                                                Yes, Delete!
                                            </button>
                                            <button
                                                :data-modal-hide="`modal${item.id}`"
                                                type="submit"
                                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                                            >
                                                No, Cencel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-else
                class="text-gray-400 dark:text-gray-400 text-center mt-24 text-lg"
            >
                No Users available
            </div>
        </div>
</template>

<script setup>
import { defineProps } from 'vue';
const {getFirstLetter} = useUsers();
const props = defineProps({
  columns: {
    type: Array,
    required: true,
  },
  data: {
    type: Array,
    required: true,
  },
});
</script>