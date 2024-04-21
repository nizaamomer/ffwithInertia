<!-- @format -->

<template>
	<div
		class="flex flex-col justify-center w-full min-h-screen overflow-auto bg-slate-900"
	>
		<div
			class="bg-slate-700 w-full h-[98vh] grid grid-cols-5 mx-auto text-gray-300 rounded overflow-hidden text-center text-base"
		>
			<div
				class="bg-slate-900/90 text-gray-300 col-span-full lg:col-span-3 px-1.5 overflow-auto"
			>
				<div
					class="items-center justify-between block min-w-full pb-3 space-y-2 lg:flex lg:space-y-0"
				>
					<div class="flex items-center justify-start">sarawa</div>
					<div class="w-full lg:w-auto">
						<div class="relative w-full sm:w-fit">
							<label for="table-search" class="sr-only">Search</label>
							<div
								class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
							>
								<svg
									class="w-5 h-5 text-rose-400"
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
								v-model.trim="search"
								@input="searchFunc"
								name="search"
								class="block w-full p-2 pl-10 text-sm text-gray-400 bg-gray-800 border rounded-lg placeholder:text-gray-500 border-rose-500/90 focus:border-rose-600 sm:w-80 focus:bg-gray-900 focus:outline-none focus:ring-0"
								placeholder="بگەڕێ بە دوای ..."
							/>
						</div>
					</div>
				</div>
				<!-- <div class="flex justify-between px-1 mb-5">
                    <div class="">
                        <div class="text-2xl">Nizam Omer</div>
                        <p class="text-base text-gray-300">23/3/2020</p>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none bottom-3"
                        >
                            <svg
                                class="w-5 h-5 text-gray-900 dark:text-indigo-400"
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
                            v-model.trim="search"
                            @input="searchFunc"
                            type="search"
                            id="table-search"
                            name="search"
                            class="block p-2 pl-10 w-full text-gray-200 border border-indigo-300 rounded-lg bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500 focus:transition focus:duration-[4000ms] focus:ease-in-out"
                        />
                    </div>
                </div>-->

				<SmallCard
					v-for="category in categories"
					:key="category.id"
					:items="category.foods"
					@add-to-cart="offerStore.addToCart"
				/>
			</div>

			<div
				class="flex flex-col justify-between h-full overflow-auto text-gray-300 bg-gray-900 col-span-full lg:col-span-2"
			>
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg h-fit">
					<table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
						<thead
							class="sticky top-0 text-xs text-center uppercase bg-gray-800 text-rose-500"
						>
							<tr>
								<th scope="col" class="px-5 py-3">جۆری خواردن</th>
								<th scope="col" class="px-5 py-3">بڕ</th>
								<th scope="col" class="px-5 py-3">نرخ</th>
								<th scope="col" class="px-5 py-3">گشتی</th>
								<th scope="col" class="px-5 py-3">لابردن</th>
							</tr>
						</thead>
						<tbody>
							<tr
								v-if="cartItems?.length > 0"
								v-for="item in cartItems"
								:key="item.id"
								class="text-center text-gray-300 border-b border-gray-500 bg-slate-900 hover:bg-gray-900"
							>
								<th
									scope="row"
									class="w-1/5 py-3 font-medium text-left text-gray-300 ps-2 rtl:text-right"
								>
									<div class="w-24 overflow-auto whitespace-nowrap">
										{{ item.name }}
									</div>
								</th>

								<td class="flex items-center justify-center px-2 py-3">
									<button
										@click="offerStore.decreaseQuantity(item.id)"
										class="p-1 text-red-700 bg-red-300 rounded cursor-pointer"
									>
										<svg
											xmlns="http://www.w3.org/2000/svg"
											fill="none"
											viewBox="0 0 24 24"
											stroke-width="1.5"
											stroke="currentColor"
											class="w-4 h-4 p-0.5"
										>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												d="M19.5 12h-15"
											/>
										</svg>
									</button>
									<span>
										<input
											type="number"
											name="quantity"
											id="quantity"
											min="1"
											v-model="item.quantity"
											@change="offerStore.updateQuantity(item.id, item.quantity)"
											class="block pr-3.5 w-10 rounded p-0.5 appearance-none outline-none border-none text-sm text-gray-200 bg-transparent focus:outline-none"
										/>
									</span>
									<button
										@click="offerStore.increaseQuantity(item.id)"
										class="p-1 text-blue-700 bg-blue-300 rounded cursor-pointer"
									>
										<svg
											xmlns="http://www.w3.org/2000/svg"
											fill="none"
											viewBox="0 0 24 24"
											stroke-width="1.5"
											stroke="currentColor"
											class="w-4 h-4 p-0.5"
										>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												d="M12 4.5v15m7.5-7.5h-15"
											/>
										</svg>
									</button>
								</td>

								<td class="px-5 py-3">
									<span class="text-indigo-500">
										{{ item.price }}
									</span>
								</td>
								<td class="px-4 py-3 text-left">
									{{ item.quantity * item.price }}
								</td>
								<td class="px-3 py-3">
									<button @click="offerStore.removeFromCart(item.id)">
										<svg
											fill="none"
											viewBox="0 0 24 24"
											stroke-width="1.5"
											stroke="currentColor"
											class="w-4 h-4 text-red-500 cursor-pointer sm:w-5 sm:h-5 hover:text-red-600"
										>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
											/>
										</svg>
									</button>
								</td>
							</tr>

							<tr v-else>
								<div
									class="absolute text-sm text-center text-gray-400 transform -translate-x-1/2 dark:text-gray-400 top-36 left-1/2"
								>
									هیچ خواردننێک زیاد نەکراوە
								</div>
							</tr>
						</tbody>
					</table>
				</div>

				<form
					@submit.prevent="payment"
					class="grid grid-cols-1 p-2 py-3 pb-5 text-right bg-slate-950 sm:grid-cols-2 rounded-t-md gap-y-5 gap-x-0"
				>
					<div>
						<label for="name" class="text-sm font-medium text-gray-400">
							نــاوی ئۆفەر:
						</label>

						<input
							type="text"
							id="name"
							v-model="form.name"
							class="block w-4/5 py-2 text-sm text-gray-300 border border-none rounded-lg bg-slate-800 focus:bg-gray-900 placeholder:text-gray-500 focus:ring-rose-500 focus:border-rose-500"
							placeholder="ئۆفەری خێزانی"
						/>
					</div>
					<div>
						<label for="price" class="text-sm font-medium text-gray-400">
							نرخی ئــۆفەر:
						</label>

						<input
							type="number"
							id="price"
							v-model="form.price"
							class="block w-4/5 py-2 text-sm text-gray-300 border border-none rounded-lg bg-slate-800 focus:bg-gray-900 placeholder:text-gray-500 focus:ring-rose-500 focus:border-rose-500"
							placeholder="12500"
						/>
					</div>
					<div>
						<label for="note" class="text-sm font-medium text-gray-400">
							تــێبینی:
						</label>

						<textarea
							type="number"
							id="note"
							v-model="form.description"
							class="block w-4/5 py-2 text-sm text-gray-300 border border-none rounded-lg resize-none bg-slate-800 focus:bg-gray-900 focus:ring-rose-500 focus:border-rose-500 h-11"
							placeholder="..."
						/>
					</div>
					<div class="w-full">
						<label for="status" class="text-sm font-medium text-gray-400">
							بــــار:
						</label>
						<select
							id="status"
							v-model="form.status"
							class="block w-4/5 py-3 text-sm text-gray-300 border border-none rounded-lg bg-slate-800 focus:bg-gray-900 focus:ring-rose-500 focus:border-rose-500"
						>
							<option value="active">چــالاک</option>
							<option value="inactive">نــا چــالاک</option>
						</select>
					</div>

					<div class="flex justify-between px-2">
						<div class="flex items-center">
							<div class="text-base dark:text-gray-400">
								کۆی گشتی:
								{{ totalAmount ? totalAmount.toLocaleString() : "" }}

								<span class="text-indigo-500"> د.ع </span>
							</div>
						</div>
					</div>
					<button
						type="submit"
						class="py-2.5 bg-rose-800 w-4/5 hover:bg-rose-900 cursor-pointer px-10 text-sm font-medium whitespace-nowrap rtl:ml-2 text-white focus:outline-none rounded-lg"
						:disabled="form.discount == '' || form.price == ''"
						:class="{
							' bg-rose-900 cursor-not-allowed': form.discount == '' || form.price == '',
							' bg-rose-800 hover:bg-rose-900 cursor-pointer ':
								form.discount !== '' || form.price !== '',
						}"
					>
						<span v-if="route.params.id">تــازەکردنەوەی ئۆفەر</span>
						<span v-else> زیادکردنی ئۆفەر</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</template>
<script setup>

import { computed, onBeforeMount, ref, watch } from "vue";

import { useOfferCartStore } from "@/stores/offerCartStore";
const offerStore = useOfferCartStore();

import SmallCard from "@/Components/smallCard.vue";
const route = useRoute();
onBeforeMount(() => {
	if (route.params.id) {
		getOffer(route.params.id);
	}
});
const { getCategories, categories, searchFunc, search } = usePos();
const { storeOffer, updateOffer, form, getOffer } = useOffers();
getCategories();

initFlowbite();
const resetForm = () => {
	form.name = "";
	form.description = "";
	form.status = "active";
	form.price = "";
};
const cartItems = computed(() => offerStore.cartItems);
const totalAmount = computed(() => offerStore.totalAmount);
const payment = async () => {
	form.totalAmount = totalAmount.value;
	if (route.params.id) {
		await updateOffer(route.params.id, form, cartItems.value);
		resetForm();
		offerStore.clearCart();
	} else {
		await storeOffer(form, cartItems.value);
		resetForm();
		offerStore.clearCart();
	}
};
</script>
