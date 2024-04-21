<template>
    <div class="flex h-screen bg-slate-900">
        <Navbar />
        <div class="w-full h-full overflow-y-auto pb-4">
        
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/Components/navbar.vue";
</script>
