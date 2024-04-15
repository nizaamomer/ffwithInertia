<template>
    <div class="relative z-0 w-full mb-5 group">
        <input
            :type="type"
            :name="name"
            :id="name"
            :autocomplete="name"
            @focus="errors = []"
            :value="modelValue"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-emerald-500 focus:outline-none focus:ring-0 focus:border-emerald-600 peer"
        />
        <label
            :for="name"
            
            class="peer-focus:font-medium absolute after:content-['*'] after:mr-0.5 after:text-red-500 text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-emerald-600 peer-focus:dark:text-emerald-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
            >{{ label }}</label
        >
        <div
            v-if="errors && errors.length > 0"
            class="mt-1 text-sm text-red-400"
        >
            {{ errors}}
        </div>
    </div>

</template>

<script setup>
import { defineProps, ref } from "vue";

const props = defineProps({
    name: String,
    label: String,
    type: {
        type: String,
        default: "text",
    },
    placeholder: String,
    modelValue: {
        type: [String, Boolean],
        default: "",
    },
    errors: {
        type: Array,
        default: () => [],
    },
});
</script>
