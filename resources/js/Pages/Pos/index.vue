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
					<div class="flex items-center justify-start text-xl me-10" dir="ltr">
						{{ currentTime }}
					</div>
					<div class="w-full lg:w-auto">
						<InputSearch
							class="relative w-full sm:w-fit"
							@searchFunc="searchFunc"
							v-model.trim="search"
						/>
					</div>
				</div>

				<SmallCard
					v-for="category in categories"
					:key="category.id"
					:items="category.foods"
					@add-to-cart="cartStore.addToCart"
				/>
			</div>

			<div
				class="flex flex-col justify-between h-full overflow-auto text-gray-300 bg-gray-900 col-span-full lg:col-span-2"
			>
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg h-fit">
					<table class="w-full text-sm text-right text-gray-500">
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
										@click="
											cartStore.decreaseQuantity({
												itemId: item.id,
												type: item.type,
											})
										"
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
											@change="
												cartStore.updateQuantity({
													itemId: item.id,
													quantity: item.quantity,
													type: item.type,
												})
											"
											class="block pr-3.5 w-10 rounded p-0.5 appearance-none outline-none border-none text-sm text-gray-200 bg-transparent focus:outline-none"
										/>
									</span>
									<button
										@click="
											cartStore.increaseQuantity({
												itemId: item.id,
												type: item.type,
											})
										"
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
								<td class="px-2 py-3 space-x-2 text-right">
									<span v-if="item?.totalAmount" class="text-red-500 line-through">
										{{ item?.totalAmount }}
									</span>
									<span class="text-indigo-500">
										{{ item?.price }}
									</span>
								</td>
								<td class="px-4 py-3 text-left">
									{{ (item.quantity * item.price).toLocaleString() }}
								</td>
								<td class="px-3 py-3">
									<button
										@click="
											cartStore.removeFromCart({
												itemId: item.id,
												type: item.type,
											})
										"
									>
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

							<!-- <tr>
								<div
									class="absolute text-sm text-center text-gray-400 transform -translate-x-1/2 top-36 left-1/2"
								>
									هیچ خواردننێک زیاد نەکراوە
								</div>
							</tr> -->
						</tbody>
					</table>
				</div>

				<form
					@submit.prevent="payment"
					class="p-2 py-4 pb-8 space-y-4 overflow-hidden bg-slate-950 rounded-t-md h-fit"
				>
					<div class="flex justify-between px-2">
						<div>
							<div class="flex items-center space-x-2 space-x-reverse">
								<label for="discount" class="text-sm font-medium text-gray-400">
									داشکاندن:
								</label>

								<input
									type="number"
									v-model="form.discount"
									class="bg-slate-800 focus:bg-gray-900 border w-1/2 border-none text-gray-300 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block py-1.5"
									placeholder="750"
								/>
							</div>
							<p
								v-if="form.discount > totalFoodAmount"
								class="py-1 text-xs text-right text-red-400"
							>
								تکایە نابێت داشکاندن زیاتر بێت لە بڕی گشتی
							</p>
						</div>
						<div class="flex items-center">
							<div class="text-base">
								کۆی گشتی:
								{{
									totalFoodAmount
										? (totalFoodAmount - form.discount).toLocaleString()
										: ""
								}}

								<span class="text-indigo-500"> د.ع </span>
							</div>
						</div>
					</div>
					<div class="flex justify-between h-full">
						<div v-if="offers" class="overflow-auto">
							<h1 class="mb-2 text-gray-400">وەجبــەکــان</h1>
							<div class="grid grid-cols-2 gap-1">
								<div v-for="offer in offers" :key="offer.id">
									<div
										class="hover:cursor-pointer px-3 py-1.5 rounded bg-teal-800 hover:bg-teal-900 flex justify-between items-center w-full"
									>
										<button
											@click="
												cartStore.addToCart({
													item: offer,
													type: 'offer',
												})
											"
											type="button"
											class="w-full text-sm font-medium text-gray-300 whitespace-nowrap rtl:ml-2 focus:outline-none"
										>
											{{ offer.name }}
										</button>
										<div
											type="button"
											class="text-center text-black"
											@click="selectOffer(offer)"
										>
											<svg
												fill="currentColor"
												width="20"
												height="20"
												version="1.1"
												id="lni_lni-eye"
												xmlns="http://www.w3.org/2000/svg"
												xmlns:xlink="http://www.w3.org/1999/xlink"
												x="0px"
												y="0px"
												viewBox="0 0 64 64"
												style="enable-background: new 0 0 64 64"
												xml:space="preserve"
											>
												<g>
													<g>
														<path
															d="M32,52.7C12.2,52.7,2.4,33.8,2,33c-0.3-0.6-0.3-1.4,0-2c0.4-0.8,10.2-19.6,30-19.6c19.8,0,29.6,18.8,30,19.6
        c0.3,0.6,0.3,1.4,0,2C61.6,33.8,51.8,52.7,32,52.7z M6.6,32C8.8,35.7,17.4,48.2,32,48.2c14.6,0,23.2-12.5,25.4-16.2
        C55.2,28.3,46.6,15.8,32,15.8C17.4,15.8,8.8,28.3,6.6,32z"
														/>
													</g>
													<g>
														<path
															d="M32,40.5c-4.7,0-8.5-3.8-8.5-8.5c0-4.7,3.8-8.5,8.5-8.5c4.7,0,8.5,3.8,8.5,8.5C40.5,36.7,36.7,40.5,32,40.5z M32,28
        c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4C36,29.8,34.2,28,32,28z"
														/>
													</g>
												</g>
											</svg>
										</div>
									</div>
									<div
										class="flex flex-col w-24 h-full px-2 py-1 overflow-x-auto rounded"
									>
										<div
											v-if="selectedOffer === offer && isOfferSectionVisible"
											class="block h-[70vh] overflow-auto absolute bottom-6 rounded bg-slate-800 p-2 left-4"
										>
											<h1 class="font-semibold">
												{{ offer.price.toLocaleString() }}
											</h1>
											<div
												class="hover:cursor-pointer"
												v-for="item in filteredOfferItems"
												:key="item.id"
											>
												<div
													class="relative flex flex-col justify-end w-32 h-32 space-y-3"
												>
													<img
														:src="item.food.fullPathFoodImage"
														class="absolute top-0 left-0 right-0 z-50 object-contain mx-auto h-14"
													/>
													<div
														class="relative w-full space-y-1 text-center bg-gray-900 rounded-lg shadow-xl h-4/5 pt-9"
													>
														<span
															class="absolute top-0 left-0 p-1 text-xs font-semibold leading-4 text-center text-black bg-rose-500 rounded-tl-md rounded-br-md"
															>{{ item.quantity }}X</span
														>

														<h1 class="text-sm w-full overflow-auto text-clip px-0.5">
															{{ item.food.name }}
														</h1>
														<h1 class="text-sm text-rose-500">
															{{ item.food.price }}
														</h1>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div
							class="flex flex-col items-center justify-start w-2/5 py-1 space-y-3 overflow-auto ps-2"
						>
							<div class="flex items-center justify-between w-full">
								<h1 class="text-gray-400">پــرنت؟</h1>
								<select
									v-model="form.print"
									class="py-2 mx-3 text-sm font-medium text-center text-white border-none rounded-lg bg-emerald-800 whitespace-nowrap rtl:ml-2 focus:outline-none"
								>
									<option :value="false">نـــەخێر</option>
									<option :value="true">بــەڵێ</option>
								</select>
							</div>
							<button
								type="submit"
								class="w-full py-2 text-sm font-medium text-white rounded-lg px-14 whitespace-nowrap rtl:ml-2 focus:outline-none"
								:class="{
									' bg-yellow-900 cursor-not-allowed': form.discount > totalFoodAmount,
									' bg-yellow-800 hover:bg-yellow-900 cursor-pointer ':
										form.discount <= totalFoodAmount,
								}"
								:disabled="form.discount > totalFoodAmount"
								@click="form.status = 'cash'"
							>
								حــازر
							</button>

							<button
								type="submit"
								class="w-full px-10 py-2 text-sm font-medium text-white rounded-lg whitespace-nowrap rtl:ml-2 focus:outline-none"
								:class="{
									' bg-indigo-900 cursor-not-allowed': form.discount > totalFoodAmount,
									' bg-indigo-800 hover:bg-indigo-900 cursor-pointer ':
										form.discount <= totalFoodAmount,
								}"
								:disabled="form.discount > totalFoodAmount"
								@click="form.status = 'togo'"
							>
								ســەفەری
							</button>
							<button
								type="submit"
								class="w-full px-10 py-2 text-sm font-medium text-white rounded-lg whitespace-nowrap rtl:ml-2 focus:outline-none"
								:class="{
									' bg-rose-900 cursor-not-allowed': form.discount > totalFoodAmount,
									' bg-rose-800 hover:bg-rose-900 cursor-pointer ':
										form.discount <= totalFoodAmount,
								}"
								:disabled="form.discount > totalFoodAmount"
								@click="form.status = 'delivery'"
							>
								دیـــلیڤەری
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- <div
        v-if="invoice.id"
        id="invoiceContent"
        class="relative hidden max-w-md p-3 mx-auto space-y-3 text-gray-300 rounded-lg shadow bg-slate-900 rtl:text-right"
    >
        <div>
            <h1
                class="text-base leading-relaxed text-center text-indigo-500 text-md"
            >
                بــەخێربێن بۆ فــاست فوودی یــۆناس
            </h1>
            <p class="leading-relaxed text-center text-gray-500">
                ژمــارەی وەســڵ: {{ invoice.id }}
            </p>
        </div>
        <ul
            class="max-w-md text-sm leading-relaxed text-right text-gray-500 divide-y divide-gray-200"
        >
            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        کــاشێر
                    </div>
                    <div class="inline-flex items-center">
                        {{ invoice.username }}
                    </div>
                </div>
            </li>

            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        بــەروار
                    </div>
                    <div class="inline-flex items-center">
                        {{
                            invoice.date?.split("T")[1].slice(0, 8) +
                            " - " +
                            invoice.date?.split("T")[0]
                        }}
                    </div>
                </div>
            </li>
            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        جۆری پـارەدان
                    </div>
                    <div class="inline-flex items-center uppercase">
                        <span class="text-indigo-500 uppercase">
                            <span
                                class="text-sm text-cyan-500"
                                v-if="invoice.status === 'cash'"
                            >
                                حــازر
                            </span>
                            <span
                                v-else-if="invoice.status == 'togo'"
                                class="text-sm text-yellow-400"
                            >
                                ســەفەری
                            </span>
                            <span
                                v-else-if="invoice.status == 'delivery'"
                                class="text-sm text-rose-500"
                            >
                                دیـلیڤـەری
                            </span>
                        </span>
                    </div>
                </div>
            </li>
            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        جــۆری خــواردن
                    </div>
                    <div class="inline-flex items-center">نـرخ. دانــە</div>
                    <div class="inline-flex items-center">کــۆی نــرخ</div>
                </div>
            </li>
            <li
                v-for="item in invoice.invoice_items"
                :key="item.id"
                class="py-1.5 sm:py-2"
            >
                <div class="flex items-center justify-between">
                    <div
                        class="inline-flex flex-wrap items-center w-auto font-bold truncate"
                    >
                        {{ item.name }}
                    </div>
                    <div class="inline-flex items-center">
                        {{ item.price.toLocaleString() }}. ({{ item.quantity }})
                    </div>
                    <div class="inline-flex items-center">
                        {{ parseFloat(item.subTotal).toLocaleString() }}
                        <span class="mr-1 text-indigo-500"> د.ع </span>
                    </div>
                </div>
            </li>
            <li class="py-1.5 sm:py-2 mt-3">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        کــۆی گــشتی پــسووڵە
                    </div>
                    <div class="inline-flex items-center">
                        {{
                            invoice.invoice_items
                                ?.reduce(
                                    (total, item) =>
                                        total + parseFloat(item.subTotal),
                                    0
                                )
                                .toLocaleString()
                        }}

                        <span class="mr-1 text-indigo-500"> د.ع </span>
                    </div>
                </div>
            </li>
            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        داشکاندن
                    </div>
                    <div class="inline-flex items-center">
                        {{ invoice.discount?.toLocaleString() }}
                        <span class="mr-1 text-indigo-500"> د.ع </span>
                    </div>
                </div>
            </li>
            <li class="py-1.5 sm:py-2">
                <div class="flex items-center justify-between">
                    <div class="inline-flex items-center font-bold">
                        کــۆی گــشتی
                    </div>
                    <div class="inline-flex items-center">
                        {{ invoice.totalFoodAmount?.toLocaleString() }}
                        <span class="mr-1 text-indigo-500"> د.ع </span>
                    </div>
                </div>
            </li>
        </ul>
    </div> -->
</template>
<script setup>
import InputSearch from "@/Components/inputSearch.vue";

import { useFoodCartStore } from "@/stores/foodCartStore";
const cartStore = useFoodCartStore();
import SmallCard from "@/Components/smallCard.vue";
import { computed, onBeforeUnmount, reactive, ref, watch } from "vue";
const {
	getCategories,
	categories,
	offers,
	errors,
	searchFunc,
	destroy,
	search,
	pay,
	message,
	selectedOffer,
	isOfferSectionVisible,
	filteredOfferItems,
	selectOffer,
	invoice,
} = usePos();
getCategories();

const cartItems = computed(() => cartStore.cartItems);
const totalFoodAmount = computed(() => cartStore.totalAmount);

const form = reactive({
	discount: 0,
	status: "",
	print: false,
	totalAmount: totalFoodAmount,
});
const currentTime = ref(new Date().toLocaleTimeString());

const intervalId = setInterval(() => {
	currentTime.value = new Date().toLocaleTimeString();
}, 1000);

onBeforeUnmount(() => {
	clearInterval(intervalId);
});
const resetForm = () => {
	form.discount = 0;
	form.status = "";
};
const payment = async () => {
	const paymentData = {
		...form,
		totalAmount: form.totalAmount - form.discount,
	};
	await pay(paymentData, cartItems.value);
	resetForm();
	cartStore.clearCart();
};
</script>
