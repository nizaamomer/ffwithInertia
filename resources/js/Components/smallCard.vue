<template>
    <div class="flex items-center justify-start w-full">
        <div
            class="grid grid-flow-col auto-cols-max rounded gap-x-2 h-full py-1 w-full overflow-x-auto"
        >
        <!-- <p class="pl-2">{{ category.name }}</p> -->
            <div
                v-for="item in items"
                :key="item.id"
                @click="$emit('add-to-cart', { item, type: 'food' })"
                class="h-32 w-32 relative flex flex-col justify-end cursor-pointer"
            >
                <img
                    :src="item.fullPathFoodImage"
                    class="object-contain h-16 w-16 absolute left-0 right-0 mx-auto top-0 cursor-pointer rounded-full"
                />
                <div
                    class="h-[75%] w-full bg-gray-800 hover:bg-rose-700/80 group pt-8 rounded-lg text-center space-y-1 shadow-2xl"
                >
                    <h1
                        class="text-[13px] w-full overflow-auto text-clip px-0.5"
                    >
                        {{ item.name }}
                    </h1>
                    <h1 class="text-sm text-rose-500 group-hover:text-black">
                        {{ item.price }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

defineProps({
    items: {
        type: Array,
        required: true,
    },
});
</script>
