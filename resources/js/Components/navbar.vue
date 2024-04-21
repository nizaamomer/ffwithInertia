<template>
    <div class="min-h-screen flex flex-col justify-center">
            <button
                @click="toggleSidebar"
                class="absolute w-full bg-slate-950 top-0 py-2 ms-10 md:hidden  text-start block"
            >
                <svg
                    class="w-7 h-7 fill-white"
                    prop
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 5.5a.5.5 0 0 1 .5-.5h17a.5.5 0 0 1 0 1h-17a.5.5 0 0 1-.5-.5Z"
                        clip-rule="evenodd"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        d="M3 12a.5.5 0 0 1 .5-.5h17a.5.5 0 0 1 0 1h-17A.5.5 0 0 1 3 12Z"
                        clip-rule="evenodd"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        d="M3 18.5a.5.5 0 0 1 .5-.5h17a.5.5 0 0 1 0 1h-17a.5.5 0 0 1-.5-.5Z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
        <aside
            class="md:flex md:my-2 md:h-[97vh] md:w-24 md:items-center px-4 z-40 w-screen absolute top-2 left-0 right-0 md:flex-col md:rounded-l-lg bg-slate-950 duration-300 md:relative py-5 text-slate-100"
            :class="{'md:w-48':asideShow,
                     'hidden':sidebarShow,
            }"
        >
            <!--  pl-8 pr-2    ama la bchukaka la adain-->
            <button @click="toggleAside" class="absolute top-2 left-2">
                <svg
                    class="md:inline hidden"
                    :class="asideShow ? 'rotate-180' : ''"
                    fill="#bdbaba"
                    width="25"
                    height="25"
                    version="1.1"
                    id="lni_lni-chevron-left-circle"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px"
                    y="0px"
                    viewBox="0 0 64 64"
                    style="enable-background: new 0 0 64 64"
                    xml:space="preserve"
                >
                    <g>
                        <path
                            d="M32,1.8C15.3,1.8,1.8,15.3,1.8,32S15.3,62.3,32,62.3S62.3,48.7,62.3,32S48.7,1.8,32,1.8z M32,57.8
		                C17.8,57.8,6.3,46.2,6.3,32C6.3,17.8,17.8,6.3,32,6.3c14.2,0,25.8,11.6,25.8,25.8C57.8,46.2,46.2,57.8,32,57.8z"
                        />
                        <path
                            d="M40.2,16.9c-0.9-0.9-2.3-0.9-3.2,0L23.8,30.4c-0.9,0.9-0.9,2.3,0,3.2L37,47.1c0.4,0.4,1,0.7,1.6,0.7c0.6,0,1.1-0.2,1.6-0.6
		                    c0.9-0.9,0.9-2.3,0-3.2L28.5,32l11.7-11.9C41.1,19.2,41.1,17.7,40.2,16.9z"
                        />
                    </g>
                </svg>
            </button>

            <div
                class="flex items-center text-center justify-center px-8"
                :class="asideShow ? '' : ''"
            >
                <div
                    @click="toggleFullscreen"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-800/70"
                >
                    <!-- v-if="user && user?.image" -->
                    <img
                        v-if="user?.image"
                        :src="user.fullPathUserImage"
                        :alt="user?.name"
                        class="object-cover h-12 w-12 rounded-full"
                    />
                    <div
                        v-else
                        id="circleIcon"
                        class="w-7 h-7 text-center mt-2 text-indigo-300 bg-center bg-cover bg-no-repeat"
                    >
                        {{ getFirstLetter(user?.name) }}
                    </div>
                </div>
                <div v-if="asideShow" class="flex flex-1 flex-col space-y-1">
                    <div
                        class="font-medium text-sm leading-tight text-gray-200"
                    >
                        {{ user?.name }}
                    </div>
                    <div class="text-xs text-gray-400">
                        <span
                            v-if="user?.isAdmin"
                            class="bg-indigo-700 text-indigo-100 rounded-xl px-2"
                        >
                            ئەدمین
                        </span>
                        <span
                            v-else
                            class="bg-rose-700 text-rose-100 rounded-xl px-2"
                        >
                            کاشێر
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="mt-10 flex flex-1 flex-col gap-3 px-4 text-slate-400 text-sm overflow-auto"
            >
                <router-link
                    :to="{ name: 'pos.index' }"
                    class="flex items-center gap-3 rounded-xl py-3 px-5"
                    active-class="bg-slate-800 text-indigo-500"
                >
                    <div>
                        <svg
                            fill="currentColor"
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 64 64"
                        >
                            <path
                                d="M56,3.8H8c-3.4,0-6.3,2.8-6.3,6.3v30.2c0,3.4,2.8,6.3,6.3,6.3h15.7l-2.5,9.2h-4.5c-1.2,0-2.3,1-2.3,2.3s1,2.3,2.3,2.3h30.5
	c1.2,0,2.3-1,2.3-2.3s-1-2.3-2.3-2.3h-4.5l-2.5-9.2H56c3.4,0,6.3-2.8,6.3-6.3V10.1C62.3,6.6,59.4,3.8,56,3.8z M38.2,55.7H25.8
	l2.5-9.2h7.3L38.2,55.7z M57.8,40.2c0,1-0.8,1.8-1.8,1.8H8c-1,0-1.8-0.8-1.8-1.8V10.1c0-1,0.8-1.8,1.8-1.8h48c1,0,1.8,0.8,1.8,1.8
	V40.2z"
                            />
                        </svg>
                    </div>
                    <div v-if="asideShow">فرۆشتــن</div>
                </router-link>
                <router-link
                    v-show="user?.isAdmin"
                    :to="{ name: 'dashboard.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            class="w-6 h-6"
                            prop
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M11.25 5.788a7.251 7.251 0 1 0 7.962 7.962H12a.75.75 0 0 1-.75-.75V5.788ZM3.25 13A8.75 8.75 0 0 1 12 4.25a.75.75 0 0 1 .75.75v7.25H20a.75.75 0 0 1 .75.75 8.75 8.75 0 1 1-17.5 0Z"
                                clip-rule="evenodd"
                            ></path>
                            <path
                                fill-rule="evenodd"
                                d="M15.5 4.674V9.5h4.826A6.512 6.512 0 0 0 15.5 4.674Zm-.502-1.612c3.62.45 6.49 3.32 6.94 6.94.069.548-.386.998-.938.998h-6.5a.5.5 0 0 1-.5-.5V4c0-.552.45-1.007.998-.938Z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <div v-if="asideShow">داشــبـۆرد</div>
                </router-link>
                <router-link
                    :to="{ name: 'profile' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <i class="fa-regular fa-circle-user text-xl"></i>
                    <div v-if="asideShow">ئەکاونتەکەم</div>
                </router-link>

                <router-link
                    :to="{ name: 'category.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            fill="currentColor"
                            class="h-6 w-6"
                            viewBox="0 0 64 64"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g>
                                <path
                                    d="M21.7,3.4H9c-3.4,0-6.2,2.8-6.2,6.2v12.7c0,3.4,2.8,6.2,6.2,6.2h12.7c3.4,0,6.2-2.8,6.2-6.2V9.7C28,6.2,25.2,3.4,21.7,3.4z
		 M23.5,22.4c0,1-0.8,1.8-1.8,1.8H9c-1,0-1.8-0.8-1.8-1.8V9.7c0-1,0.8-1.8,1.8-1.8h12.7c1,0,1.8,0.8,1.8,1.8V22.4z"
                                />
                                <path
                                    d="M55,3.4H42.3c-3.4,0-6.2,2.8-6.2,6.2v12.7c0,3.4,2.8,6.2,6.2,6.2H55c3.4,0,6.2-2.8,6.2-6.2V9.7C61.2,6.2,58.4,3.4,55,3.4z
		 M56.8,22.4c0,1-0.8,1.8-1.8,1.8H42.3c-1,0-1.8-0.8-1.8-1.8V9.7c0-1,0.8-1.8,1.8-1.8H55c1,0,1.8,0.8,1.8,1.8V22.4z"
                                />
                                <path
                                    d="M21.7,35.3H9c-3.4,0-6.2,2.8-6.2,6.2v12.7c0,3.4,2.8,6.2,6.2,6.2h12.7c3.4,0,6.2-2.8,6.2-6.2V41.6
		C28,38.1,25.2,35.3,21.7,35.3z M23.5,54.3c0,1-0.8,1.8-1.8,1.8H9c-1,0-1.8-0.8-1.8-1.8V41.6c0-1,0.8-1.8,1.8-1.8h12.7
		c1,0,1.8,0.8,1.8,1.8V54.3z"
                                />
                                <path
                                    d="M55,35.3H42.3c-3.4,0-6.2,2.8-6.2,6.2v12.7c0,3.4,2.8,6.2,6.2,6.2H55c3.4,0,6.2-2.8,6.2-6.2V41.6
		C61.2,38.1,58.4,35.3,55,35.3z M56.8,54.3c0,1-0.8,1.8-1.8,1.8H42.3c-1,0-1.8-0.8-1.8-1.8V41.6c0-1,0.8-1.8,1.8-1.8H55
		c1,0,1.8,0.8,1.8,1.8V54.3z"
                                />
                            </g>
                        </svg>
                    </div>
                    <div v-if="asideShow" class="truncate">پـۆلــەکان</div>
                </router-link>
                <router-link
                    :to="{ name: 'food.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <i class="fa-solid fa-utensils text-xl"></i>

                    <div v-if="asideShow" class="flex flex-1 justify-between">
                        <div>خـــواردنـەکان</div>
                    </div>
                </router-link>
                <router-link
                    :to="{ name: 'offer.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3"
                            />
                        </svg>
                    </div>
                    <div v-if="asideShow" class="flex flex-1 justify-between">
                        <div>ئــۆفــەرەکان</div>
                    </div>
                </router-link>
                <router-link
                    v-show="user?.isAdmin"
                    :to="{ name: 'user.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            fill="currentColor"
                            class="h-6 w-6"
                            viewBox="0 0 64 64"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g>
                                <path
                                    d="M21.8,36.8c6.9,0,12.4-5.6,12.4-12.4s-5.6-12.4-12.4-12.4S9.4,17.5,9.4,24.4S15,36.8,21.8,36.8z M21.8,16.4
		c4.4,0,7.9,3.6,7.9,7.9s-3.6,7.9-7.9,7.9c-4.4,0-7.9-3.6-7.9-7.9S17.4,16.4,21.8,16.4z"
                                />
                                <path
                                    d="M21.8,39.9c-7.2,0-14.1,2.9-19.4,8.3c-0.9,0.9-0.9,2.3,0,3.2c0.4,0.4,1,0.7,1.6,0.7c0.6,0,1.2-0.2,1.6-0.7
		c4.4-4.5,10.2-7,16.2-7c5.9,0,11.7,2.5,16.2,7c0.9,0.9,2.3,0.9,3.2,0c0.9-0.9,0.9-2.3,0-3.2C35.9,42.9,29,39.9,21.8,39.9z"
                                />
                                <path
                                    d="M47.3,36.8c4,0,7.3-3.3,7.3-7.3c0-4-3.3-7.3-7.3-7.3s-7.3,3.3-7.3,7.3C39.9,33.5,43.2,36.8,47.3,36.8z M47.3,26.6
		c1.6,0,2.8,1.3,2.8,2.8c0,1.6-1.3,2.8-2.8,2.8s-2.8-1.3-2.8-2.8C44.4,27.9,45.7,26.6,47.3,26.6z"
                                />
                                <path
                                    d="M61.5,45.6c-5.3-4.9-12.6-6.9-19.9-5c-1.2,0.3-1.9,1.5-1.6,2.7c0.3,1.2,1.6,1.9,2.7,1.6c5.8-1.5,11.6,0,15.7,3.9
		c0.4,0.4,1,0.6,1.5,0.6c0.6,0,1.2-0.2,1.6-0.7C62.5,47.9,62.4,46.5,61.5,45.6z"
                                />
                            </g>
                        </svg>
                    </div>
                    <div v-if="asideShow">بــەکارهێنەران</div>
                </router-link>
                <router-link
                    :to="{ name: 'invoice.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            class="h-6 w-6"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M13.5 9.75a.75.75 0 0 0-.75-.75h-6a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 .75-.75Z"
                            ></path>
                            <path
                                d="M12.5 12.75a.75.75 0 0 0-.75-.75h-5a.75.75 0 1 0 0 1.5h5a.75.75 0 0 0 .75-.75Z"
                            ></path>
                            <path
                                d="M12.75 15a.75.75 0 1 1 0 1.5h-6a.75.75 0 0 1 0-1.5h6Z"
                            ></path>
                            <path
                                fill-rule="evenodd"
                                d="M6 21.75h13A2.75 2.75 0 0 0 21.75 19v-5.5a.75.75 0 0 0-.75-.75h-3.25V4.943c0-1.423-1.609-2.251-2.767-1.424l-.175.125a2.26 2.26 0 0 1-2.622-.004 3.77 3.77 0 0 0-4.372 0 2.26 2.26 0 0 1-2.622.004l-.175-.125c-1.158-.827-2.767 0-2.767 1.424V18A3.75 3.75 0 0 0 6 21.75ZM8.686 4.86a2.27 2.27 0 0 1 2.628 0 3.76 3.76 0 0 0 4.366.005l.175-.125a.25.25 0 0 1 .395.203V19c0 .45.108.875.3 1.25H6A2.25 2.25 0 0 1 3.75 18V4.943a.25.25 0 0 1 .395-.203l.175.125a3.76 3.76 0 0 0 4.366-.005ZM17.75 19v-4.75h2.5V19a1.25 1.25 0 0 1-2.5 0Z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <div v-if="asideShow">فــرۆشراوەکان</div>
                </router-link>
                <router-link
                    :to="{ name: 'expense.index' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M19.5 6.75h-15A2.25 2.25 0 0 0 2.25 9v9a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25Z"
                            ></path>
                            <path
                                d="M19.282 6.75V5.342A2.344 2.344 0 0 0 16.5 3.041L4.155 5.148A2.344 2.344 0 0 0 2.25 7.452V9.75"
                            ></path>
                            <path
                                fill="currentColor"
                                stroke="none"
                                d="M17.25 15a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z"
                            ></path>
                        </svg>
                    </div>
                    <div v-if="asideShow">خــەرجیـەکان</div>
                </router-link>
                <router-link
                    v-show="user?.isAdmin"
                    :to="{ name: 'report.invoices' }"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <i class="fa-regular fa-file-pdf text-xl"></i>

                    <div v-if="asideShow">ڕاپــۆرتەکان</div>
                </router-link>
            </div>
            <div
                class="flex flex-col gap-3 px-3 text-sm text-slate-400 hover:text-rose-500"
            >
                <button
                    @click="logout"
                    active-class="bg-slate-800 text-indigo-500"
                    class="flex items-center gap-3 rounded-xl py-3 px-5 hover:bg-slate-800"
                >
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                            />
                        </svg>
                    </div>
                    <div v-if="asideShow">چوونەدەرەوە</div>
                </button>
            </div>
        </aside>
    </div>
</template>
<script setup>
import { useUserStore } from "@/stores/userStore";
import useUsers from "@/Composables/users";
import { computed, onMounted, ref } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const { getFirstLetter } = useUsers();
const isFullscreen = ref(false);
const asideShow = ref(localStorage.getItem("sidebarShow")|| false);
const toggleAside = () => {
    asideShow.value = !asideShow.value;
    localStorage.setItem("sidebarShow", asideShow.value)
};
const sidebarShow = ref(false);
const toggleSidebar = () => {
    asideShow = true;
    sidebarShow.value = !sidebarShow.value;
};
const toggleFullscreen = () => {
    isFullscreen.value = !isFullscreen.value;
    if (isFullscreen.value) {
        document.documentElement.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
};
const userStore = useUserStore();
const user = computed(() => userStore.user);
const logout = async () => {
    await userStore.logout();
    router.push({ name: "login" });
};
onMounted(async () => {
    if (userStore.isLoggedIn) {
        userStore.getUser();
    }
});
</script>
