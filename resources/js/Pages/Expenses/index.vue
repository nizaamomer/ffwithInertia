<template>
    <div class="mx-5">
        <Breadcrumb :items="breadcrumbs" />
        <!-- <div v-if="errors">{{ errors }}</div> -->
        <div class="items-center justify-between block sm:flex">
            <div
                class="flex items-center justify-center my-5 space-x-3 rtl:space-x-reverse sm:my-0"
            >
                <InputSearch @searchFunc="searchFunc" v-model.trim="search" />

                <div class="flex items-center justify-between">
                    <button
                        @click="showCreateModal = !showCreateModal"
                        class="hidden px-4 py-2 text-sm font-semibold bg-gray-800 rounded-md sm:block text-rose-500 hover:bg-rose-900 hover:text-white"
                    >
                        زیادکردنی خەرجی
                    </button>
                    <button
                        @click="showCreateModal != showCreateModal"
                        class="px-4 py-2 text-sm font-medium bg-gray-800 rounded-md sm:hidden text-rose-500 hover:bg-rose-900 hover:text-white"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M7.007 12a.75.75 0 0 1 .75-.75h3.493V7.757a.75.75 0 0 1 1.5 0v3.493h3.493a.75.75 0 1 1 0 1.5H12.75v3.493a.75.75 0 0 1-1.5 0V12.75H7.757a.75.75 0 0 1-.75-.75Z"
                            ></path>
                            <path
                                fill-rule="evenodd"
                                d="M7.317 3.769a42.502 42.502 0 0 1 9.366 0c1.827.204 3.302 1.643 3.516 3.48.37 3.157.37 6.346 0 9.503-.215 1.837-1.69 3.275-3.516 3.48a42.5 42.5 0 0 1-9.366 0c-1.827-.205-3.302-1.643-3.516-3.48a40.903 40.903 0 0 1 0-9.503c.214-1.837 1.69-3.276 3.516-3.48Zm9.2 1.49a41.001 41.001 0 0 0-9.034 0A2.486 2.486 0 0 0 5.29 7.424a39.402 39.402 0 0 0 0 9.154 2.486 2.486 0 0 0 2.193 2.164c2.977.332 6.057.332 9.034 0a2.486 2.486 0 0 0 2.192-2.164 39.401 39.401 0 0 0 0-9.154 2.486 2.486 0 0 0-2.192-2.163Z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <!-- create expense modal -->
                    <div
                        v-if="showCreateModal"
                        tabindex="-1"
                        aria-hidden="true"
                        class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[60] flex justify-center items-center"
                    >
                        <div class="relative w-full max-w-md max-h-full p-4">
                            <!-- Modal content -->
                            <div
                                class="relative bg-indigo-800 rounded-lg shadow"
                            >
                                <!-- Modal header -->
                                <div
                                    class="flex items-start justify-between p-3 border-b border-gray-400 rounded-t"
                                >
                                    <h3
                                        class="pt-1 text-xl font-semibold text-gray-900"
                                    >
                                        زیــادکردنی خەرجی
                                    </h3>
                                    <button
                                        type="button"
                                        class="inline-flex items-center justify-center ml-3 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-rose-500 hover:text-gray-200 w-9 h-9"
                                        @click="showCreateModal = false"
                                    >
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
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <form @submit.prevent="save">
                                    <!-- Modal body -->
                                    <div
                                        class="p-6 space-y-3 text-left rtl:text-right"
                                    >
                                        <Input
                                            name="name"
                                            type="text"
                                            label="جـــۆری خەرجی:"
                                            placeholder="..."
                                            v-model="form.name"
                                            :errors="errors.name"
                                        />
                                        <Input
                                            name="amount"
                                            type="number"
                                            label="بــڕی پارە:"
                                            placeholder="..."
                                            v-model="form.amount"
                                            :errors="errors.amount"
                                        />
                                        <Input
                                            name="date"
                                            type="date"
                                            label="کات و بەروار:"
                                            placeholder="..."
                                            v-model="form.date"
                                            :errors="errors.date"
                                        />

                                        <div>
                                            <label
                                                for="message"
                                                class="block mb-2 text-sm font-medium text-gray-900 after:content-['(داوەکراونییە)'] after:ml-0.5 rtl:after:mr-0.5 after:text-gray-800"
                                                >تێبـــینی
                                            </label>
                                            <textarea
                                                id="message"
                                                rows="3"
                                                name="note"
                                                v-model="form.description"
                                                class="bg-slate-800 focus:bg-gray-900 border border-indigo-700 text-gray-300 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5"
                                                placeholder=" "
                                            ></textarea>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b rtl:space-x-reverse dark:border-gray-600"
                                    >
                                        <button
                                            type="submit"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none hover:ring-2 focus:ring-rose-500 hover:ring-rose-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center rtl:ml-3"
                                        >
                                            زیادکردن
                                        </button>
                                        <button
                                            @click="showCreateModal = false"
                                            type="button"
                                            class="text-gray-300 bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                        >
                                            پاشگەزبوونەوە
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

               
                    <!-- <div
                        v-for="(errorMessages, KeyName) in errors"
                        :key="KeyName"
                        dir="ltr"
                        class="absolute z-50 w-1/4 right-20 bottom-2"
                    >
                        <div
                            v-for="errorMessage in errorMessages"
                            :key="errorMessage"
                            :id="`toast-danger`"
                            class="flex items-center justify-between w-full p-4 mb-4 text-gray-500 bg-gray-800 rounded-lg shadow-xl"
                            role="alert"
                        >
                            <div
                                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-200 bg-red-800 rounded-lg"
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
                                <span class="sr-only">Error icon</span>
                            </div>
                            <div class="ml-3 text-sm font-normal rtl:mr-3">
                                {{ errorMessage }}
                            </div>
                            <button
                                type="button"
                                @click="errors = ''"
                                class="bg-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-500 hover:text-white hover:bg-gray-700"
                                :data-dismiss-target="`#toast-danger`"
                                :aria-label="`Close`"
                            >
                                <span class="sr-only">Close</span>
                                <svg
                                    class="w-3 h-3"
                                    :aria-hidden="`true`"
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
                    </div> -->
                </div>
            </div>
            
                <div
                    v-if="message"
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
                    <div class="text-sm font-medium ms-3">
                        {{ message }}
                    </div>
                </div>
        </div>
        <div
            class="bg-slate-700 h-[82vh] w-full mx-auto text-gray-300 rounded overflow-hidden text-center text-base p-1 m-3"
        >
            <div
                class="gap-2 pb-10 overflow-auto text-base text-center text-gray-300 rounded bg-slate-700 sm:pb-3"
            >
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div
                        class="relative overflow-y-scroll h-[81vh] scroll-smooth rounded-md"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 rtl:text-right"
                        >
                            <thead
                                class="sticky top-0 text-sm text-gray-500 uppercase bg-gray-900"
                            >
                                <tr
                                    class="truncate divide-x divide-x-reverse divide-indigo-400"
                                >
                                    <th scope="col" class="px-6 py-3">
                                        جـــۆری خــەرجــی
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        بــڕی پــارە
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        کـــات و بــەروار
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        تێبـــینی
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        زیادکراوە لە لایەن
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        کــردارەکــــان
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="expenses.length > 0">
                                <tr
                                    v-for="item in expenses"
                                    :key="item.id"
                                    class="w-full border-b border-indigo-500 bg-slate-900 hover:border-y-2 hover:border-rose-800"
                                >
                                    <th
                                        scope="row"
                                        class="flex items-center px-6 py-2 pt-3 pr-0 space-x-3 space-x-reverse text-center rtl:pr-3"
                                    >
                                        {{ item.name }}
                                    </th>
                                    <td class="px-6 py-4 text-center truncate">
                                        {{ item.amount.toLocaleString() }}
                                        <span class="text-indigo-500">
                                            د.ع
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center truncate">
                                        {{ item.date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{
                                            item.description
                                                ? item.description
                                                : "Empty"
                                        }}
                                    </td>
                                    <td class="px-6 py-4 text-center truncate">
                                        {{ item.addedBy }}
                                    </td>
                                    <td
                                        class="flex px-6 py-4 space-x-4 text-center align-middle justify-evenly rtl:space-x-reverse"
                                    >
                                        <button
                                            @click="
                                                toggleEditModal(item.id);
                                                getExpense(item.id);
                                            "
                                        >
                                            <svg
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-4 h-4 text-indigo-500 cursor-pointer sm:w-5 sm:h-5 hover:text-indigo-600 rtl:ml-3"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                />
                                            </svg>
                                        </button>
                                        <!-- edit main modal -->
                                        <div
                                            v-if="showEditModal[item.id]"
                                            class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[60] flex justify-center items-center"
                                        >
                                            <div
                                                class="relative w-full max-w-md max-h-full p-4"
                                            >
                                                <!-- Modal content -->
                                                <div
                                                    class="relative bg-indigo-800 rounded-lg shadow"
                                                >
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-start justify-between p-4 border-b rounded-t border-b-gray-400"
                                                    >
                                                        <h3
                                                            class="pt-1 text-xl font-semibold text-indigo-400"
                                                        >
                                                            دەستکاری کردنی
                                                            خــەرجــی
                                                        </h3>
                                                        <button
                                                            type="button"
                                                            class="inline-flex items-center justify-center ml-3 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-rose-500 hover:text-gray-200 w-9 h-9"
                                                            @click="
                                                                toggleEditModal(
                                                                    item.id
                                                                )
                                                            "
                                                        >
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
                                                            <span
                                                                class="sr-only"
                                                                >Close
                                                                modal</span
                                                            >
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <!-- Modal body -->
                                                        <div
                                                            class="p-6 space-y-3 text-left rtl:text-right"
                                                        >
                                                            <Input
                                                                name="name"
                                                                type="text"
                                                                label="جـــۆری خەرجی:"
                                                                placeholder="..."
                                                                v-model="
                                                                    expense.name
                                                                "
                                                                :errors="
                                                                    errors.name
                                                                "
                                                            />
                                                            <Input
                                                                name="amount"
                                                                type="number"
                                                                label="بــڕی پارە:"
                                                                placeholder="..."
                                                                v-model="
                                                                    expense.amount
                                                                "
                                                                :errors="
                                                                    errors.amount
                                                                "
                                                            />
                                                            <Input
                                                                name="date"
                                                                type="date"
                                                                label="کات و بەروار:"
                                                                placeholder="..."
                                                                v-model="
                                                                    expense.date
                                                                "
                                                                :errors="
                                                                    errors.date
                                                                "
                                                            />

                                                            <div>
                                                                <label
                                                                    for="message"
                                                                    class="block mb-2 text-sm font-medium text-gray-400 after:content-['(داوەنەکراوە)'] after:ml-0.5 rtl:after:mr-0.5 after:text-gray-500"
                                                                    >تێبـــینی
                                                                </label>
                                                                <textarea
                                                                    id="message"
                                                                    rows="4"
                                                                    name="note"
                                                                    v-model="
                                                                        expense.description
                                                                    "
                                                                    class="bg-slate-800 focus:bg-gray-900 border border-indigo-700 text-gray-300 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5"
                                                                    placeholder=" "
                                                                ></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="flex items-center p-6 space-x-2 border-t border-gray-600 rounded-b rtl:space-x-reverse"
                                                        >
                                                            <button
                                                                type="submit"
                                                                @click="
                                                                    update(
                                                                        expense.id
                                                                    );
                                                                    toggleEditModal(
                                                                        item.id
                                                                    );
                                                                "
                                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none hover:ring-2 focus:ring-rose-500 hover:ring-rose-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center rtl:ml-3"
                                                            >
                                                                تـازەکردنــەوە
                                                            </button>
                                                            <button
                                                                @click="
                                                                    toggleEditModal(
                                                                        item.id
                                                                    )
                                                                "
                                                                type="button"
                                                                class="text-gray-300 bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                            >
                                                                پاشگەزبوونەوە
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button
                                            @click="toggleShowDelete(item.id)"
                                        >
                                            <svg
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-4 h-4 text-red-500 cursor-pointer sm:w-5 sm:h-5 hover:text-red-600"
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
                                            v-if="showDeleteModal[item.id]"
                                            tabindex="-1"
                                            aria-hidden="true"
                                            class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[60] flex justify-center items-center"
                                        >
                                            <div
                                                class="relative w-full max-w-md max-h-full p-4"
                                            >
                                                <!-- Modal content -->
                                                {{ item.id }}
                                                <div
                                                    class="relative items-center p-5 text-center bg-gray-800 rounded-lg shadow"
                                                >
                                                    <svg
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                        class="mx-auto text-red-500 sm:w-20 sm:h-20 w-14 h-14 hover:text-red-600"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                        />
                                                    </svg>
                                                    <h1
                                                        class="py-2 text-lg text-indigo-500"
                                                    >
                                                        سڕیــنەوە!
                                                    </h1>
                                                    <p
                                                        class="dark:text-gray-300"
                                                    >
                                                        دڵنیایی لە سڕیــنەوەی
                                                        ئەم خەرجیە ؟
                                                    </p>
                                                    <div
                                                        class="flex items-center justify-center py-5 space-x-5 rtl:space-x-reverse"
                                                    >
                                                        <button
                                                            @click="
                                                                deleteExpense(
                                                                    item.id
                                                                );
                                                                toggleShowDelete(
                                                                    item.id
                                                                );
                                                            "
                                                            type="submit"
                                                            class="text-gray-300 bg-rose-700 hover:bg-rose-800 hover:ring-4 hover:ring-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-900 rounded-lg text-sm font-medium px-5 py-2.5 focus:z-10"
                                                        >
                                                            بەڵــێ بسڕەوە!
                                                        </button>

                                                        <button
                                                            @click="
                                                                toggleShowDelete(
                                                                    item.id
                                                                )
                                                            "
                                                            type="submit"
                                                            class="text-white bg-gray-700 hover:bg-gray-900 hover:ring-2 hover:ring-rose-700 focus:ring-2 focus:outline-none focus:ring-rose-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                        >
                                                            پاشگەزبوونەوە
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="nextPageUrl" class="bg-slate-900">
                                    <td colspan="100%" class="p-2 text-center">
                                        <!-- <button
                                            @click="loadMore"
                                            class="text-gray-200 bg-rose-600 hover:bg-gray-800 hover:text-rose-500 px-8 py-1.5 rounded-lg font-bold"
                                        >
                                            زیــاتــر...
                                        </button> -->
                                    </td>
                                </tr>
                            </tbody>

                            <div
                                v-else
                                class="absolute left-0 right-0 mx-auto mt-24 text-lg text-center text-gray-400"
                            >
                                هیچ خــەرجیــەک بەردەست نییــە
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import InputSearch from "@/Components/inputSearch.vue";
import Input from "@/Components/input.vue";
import Breadcrumb from "@/Components/breadcrumb.vue";
const breadcrumbs = [{ title: "خەرجیەکان", link: "/expenses" }];

    // expenses,
    // expense,
    // error,
    // errors,
    // search,
    // searchFunc,
    // getExpenses,
    // getExpense,
    // storeExpense,
    // updateExpense,
    // destroyExpense,

    // message,
    // nextPageUrl,
    // loadMore,
    
const nextPageUrl = ref(false);
const showCreateModal = ref(false);
const showDeleteModal = ref({});
const toggleShowDelete = (itemId) => {
    showDeleteModal.value[itemId] = !showDeleteModal.value[itemId];
};
const showEditModal = ref({});
const toggleEditModal = (itemId) => {
    showEditModal.value[itemId] = !showEditModal.value[itemId];
};

const form = reactive({
    name: "",
    description: "",
    amount: "",
    date: "",
});
const resetForm = () => {
    form.name = "";
    form.description = "";
    form.amount = "";
    form.date = "";
};
const save = async () => {
    // await storeExpense(form);
    // if (!errors.value) {
    //     showCreateModal.value = false;
    //     resetForm();
    //     getExpenses();
    // }
};


const deleteExpense = async (id) => {
    // await destroyExpense(id);
    // await getExpenses();
};
const update = async (id) => {
    // await updateExpense(id);
    // await getExpenses();
};
</script>
