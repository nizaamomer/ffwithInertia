<template>
    <div class="relative">
        <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
        >
            <svg
                class="w-5 h-5 text-rose-500 "
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                ></path>
            </svg>
        </div>
        <input
            type="search"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            name="search"
            placeholder="بگەڕی بە دوای...."
            class="block p-2 pl-10 text-sm placeholder:text-gray-500 text-gray-400 border border-rose-500 focus:border-rose-600 rounded-lg w-full sm:w-80 bg-gray-800 focus:bg-gray-900 focus:outline-none focus:ring-0"
        />
    </div>
</template>

<script setup>

import { defineProps, defineEmits } from "vue";
defineProps({
    modelValue: {
        type: String,
        default: "",
    },
});
defineEmits(["update:modelValue", "searchFunc"]);
</script>
