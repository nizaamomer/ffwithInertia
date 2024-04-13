<template>
    <!-- component -->
   <div class="h-screen relative bg-indigo-900 lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
                           <h1 class="text-[20rem] text-gray-400/20 absolute right-40 top-0">٤٠٤</h1>
               <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                   <div class="relative">
                       <div class="relative">
                           <div class="">
                               <h1 class="my-2 text-gray-900 font-bold text-2xl md:text-4xl">
                                   ببورە پەڕەی داواکراو نەدۆزرایەوە!
                               </h1>
                               <p class="my-2 text-lg md:text-xl text-gray-300">ببورە ئەو پەڕەیەی تۆ داوای دەکەی بەردەست نییە یان ڕێگەپێدانت بۆی نیە </p>
                               <router-link :to="{name:'home'}" class="inline-block sm:w-full lg:w-auto my-2 border rounded-lg py-4 px-8 text-center bg-teal-600 text-white font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-opacity-50">بمبەرەوە بۆ ماڵەوە!</router-link>
                           </div>
                       </div>
                       <div>
                       </div>
                   </div>
               </div>
               <div>
                   <img src="../images/error-404.png" />
               </div>
           </div>
   </template>