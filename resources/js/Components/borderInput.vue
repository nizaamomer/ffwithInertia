<template>
    <div class="mb-5">
        <input
            :type="type"
            :placeholder="placeholder"
            :id="name"
            @focus="errors = []"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="bg-gray-800 py-2.5 border-dashed border-gray-500 border placeholder:text-gray-400 text-gray-200 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-600 focus:bg-gray-900 block w-full p-2.5"
        />
        <div
            v-if="errors && errors.length > 0"
            class="mt-1 text-sm text-red-400"
        >
            {{ errors[0] }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    name: String,
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
