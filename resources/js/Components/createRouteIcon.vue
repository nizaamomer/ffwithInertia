<template>
    <Link
        :href="routeName"
        class="text-sm bg-gray-800 px-4 hidden sm:block py-2 rounded-md font-semibold text-rose-500 hover:bg-rose-900 hover:text-white"
    >
        {{ label }}
    </Link>
    <Link
        :href="routeName"
        class="text-sm bg-gray-800 sm:hidden px-4 py-2 rounded-md font-medium text-rose-500 hover:bg-rose-900 hover:text-white"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15"
            />
        </svg>
    </Link>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    routeName: String,
    label: String,
});
</script>
