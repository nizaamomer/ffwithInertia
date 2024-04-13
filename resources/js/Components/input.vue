<template>
    <div class="space-y-2">
        <label
            v-if="label"
            :for="name"
            class="text-base font-medium text-gray-400"
        >
            {{ label }}
        </label>

        <input
            :type="type"
            :placeholder="placeholder"
            :id="name"
            @focus="errors = []"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="bg-slate-800 w-full focus:bg-gray-950 resize-none focus-within:outline-none border border-none text-gray-400 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block p-2 h-11"
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
