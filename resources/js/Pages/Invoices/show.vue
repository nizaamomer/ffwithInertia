<!-- @format -->

<!-- <div class="bg-[#eeecf0] h-full overflow-auto w-full p-5">
        <h1 class="text-2xl font-sarchia">خواردنەکان</h1>
        <div
            class="bg-indigo-900 text-gray-300 w-5/6 rounded mx-auto grid grid-cols-4 gap-3 p-3"
        >
            <div
                class="bg-[#1f1d2b] rounded-lg border-[1.8px] h-64 border-gray-500 flex flex-col items-center justify-between"
            >
                {{ invoice }}
            </div>
        </div>
    </div> -->
<template>
	<div class="md:w-8/12 mx-auto w-full">
		<Breadcrumb :items="breadcrumbs" />
		<div
			class="bg-slate-700 w-full h-[90vh] space-y-3 mx-auto text-gray-400 rounded overflow-hidden text-center text-base p-2 m-0.5"
		>
			<div
				class="grid grid-rows-3 bg-gray-900 max-w-3xl mx-auto p-5 text-right rounded-md items-center space-y-4 flex-wrap text-sm dark:text-gray-400 font-semibold"
			>
				<div class="flex items-center flex-wrap relative justify-between min-w-full">
					<div class="space-y-4">
						<p class="basis-full sm:basis-auto">
							کــاشێر :
							<span class="text-indigo-500 capitalize mb-3"> {{ invoice.addedBy }}</span>
						</p>
					</div>
					<div class="space-y-2">
						<p class="basis-full sm:basis-auto">
							ژمــارەی وەســڵ:
							<span class="text-indigo-500"> {{ invoice.id }}</span>
						</p>
						<p class="basis-full sm:basis-full">
							<!-- {!! DNS1D::getBarcodeSVG("$invoice->code", 'C128', 1.3, 45, 'White', false) !!} -->
						</p>
					</div>
				</div>
				<div class="flex justify-between flex-wrap items-center">
					<p>
						کــات و بــەروار:
						<span class="text-indigo-500"> {{ invoice.date }}</span>
					</p>
					<p class="flex items-center space-x-2 space-x-reverse">
						<span> بــار:</span>
						<span class="text-indigo-500 uppercase">
							<h1 v-if="invoice.status === 'cash'">حــازر</h1>
							<h1 v-else-if="invoice.status == 'togo'">ســەفەری</h1>
							<h1 v-else-if="invoice.status == 'delivery'">دیلیڤەری</h1>
						</span>
					</p>
				</div>
				<div class="flex justify-between flex-wrap gap-2 items-center">
					<p>
						کـــۆی گــشتی:
						<span class="text-indigo-500">
							{{
								invoice.items
									?.reduce((total, item) => total + parseFloat(item.subTotal), 0)
									.toLocaleString()
							}}
						</span>
						د.ع
					</p>
					<p>
						داشــکاندن:
						<span class="text-indigo-500"> {{ invoice.discount?.toLocaleString() }}</span>
						د.ع
					</p>
					<p>
						حــسابی کۆتایی:
						<span class="text-indigo-500">
							{{ invoice.totalAmount?.toLocaleString() }}</span
						>
						د.ع
					</p>
				</div>
			</div>

			<div
				class="bg-slate-700 h-[57vh] sm:pb-3 max-w-3xl mx-auto text-gray-300 rounded text-center text-base gap-2 overflow-auto"
			>
				<div class="relative overflow-auto sm:rounded-lg">
					<table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
						<thead class="text-sm text-gray-500 sticky top-0 uppercase bg-gray-900">
							<tr class="truncate">
								<th scope="col" class="px-6 py-3">نــاوی خواردن</th>
								<th scope="col" class="px-6 py-3">نــرخ</th>
								<th scope="col" class="px-6 py-3">دانـــە</th>
								<th scope="col" class="px-6 py-3">ســەبتۆتاڵ</th>
							</tr>
						</thead>
						<tbody>
							<tr
								v-for="food in invoice.items"
								:key="food.id"
								class="bg-slate-900 border-b border-indigo-500 hover:border-y-2 hover:border-rose-800 w-full"
							>
								<td scope="row" class="px-3 py-2 truncate font-medium whitespace-nowrap">
									{{ food.name }}
								</td>
								<td class="px-3 py-2 truncate">
									{{ food?.price.toLocaleString() }}
									<span class="text-indigo-500"> د.ع </span>
								</td>
								<td class="px-3 py-2">
									{{ food.quantity }}
								</td>
								<td class="px-3 py-2">
									{{ food.subTotal?.toLocaleString()
									}}<span class="text-indigo-500 p"> د.ع </span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const appUrl = import.meta.env.VITE_APP_URL;
import useCategories from "@/composables/categories";
import useInvoices from "@/composables/invoices";
import { useRoute } from "vue-router";
import Breadcrumb from "@/components/breadcrumb.vue";
const route = useRoute();
const breadcrumbs = [
	{ title: "وەسڵەکان ", link: "/invoices" },
	{
		title: "وردەکــاری وەسڵی فــرۆشراو",
		link: `/invoice/${route.params.id}/show`,
	},
];
const {
	showInvoice,
	invoice,
	message,
	search,
	searchFunc,
	getFoodByCategory,
	getDrinks,
	showAll,
} = useInvoices();
const { getCategories, categories } = useCategories();
showInvoice(route.params.id);
</script>
