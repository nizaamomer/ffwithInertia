<template>
    <div class="flex justify-between items-center py-2 overflow-x-auto font-Bahij">
        <div class="flex justify-start items-center overflow-x-auto">
            <router-link :to="homeLink" class="text-gray-500">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                    />
                </svg>
            </router-link>
            <span
                v-for="(crumb, index) in items"
                :key="index"
                class="flex items-center"
            >
                <span v-if="index + 1 > 0" class="mx-3 text-gray-500 pt-1">
                    /
                </span>
                <router-link
                    :to="crumb.link"
                    :class="{
                        'text-rose-500  hover:underline':
                            index+1 === items.length,
                        'text-gray-500': index+1 !== items.length,
                    }"
                >
         
                    {{ crumb.title }}
                </router-link>
            </span>
        </div>
        <button
            @click="$router.back()"
            class="text-sm bg-rose-500 px-3 py-1.5 rounded-md font-normal text-black hover:bg-rose-600"
        >
            گەڕانەوە
        </button>
    </div>
</template>
<script setup>
defineProps({
    items: {
        type: Array,
        required: true,
    },
});
const homeLink = "/";
</script>
