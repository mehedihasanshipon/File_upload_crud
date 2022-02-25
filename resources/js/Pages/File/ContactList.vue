<template>
	<app-layout>
		<!--  -->
		<div class="flex flex-col lg:flex-row justify-between lg:items-center my-2 lg:my-4">
			<div class="flex-1 flex gap-2 order-2 lg:order-1"></div>
			<div class="mb-2 lg:mb-0 ml-auto order-1 lg:order-2">
				<div class="flex gap-x-2">
					<!--  -->
					<Link :href="route('import.file')" class="relative overflow-hidden ml-5 bg-cyan-400 text-white py-2 px-3 border border-cyan-400 rounded-md shadow-sm text-sm leading-4 font-medium hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Import CSV </Link>
					<!--  -->
				</div>
			</div>
		</div>
		<!--  -->
		<div class="flex flex-col">
			<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">State</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zip</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">upload Date</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(contact, index) in contacts.data" :key="index" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ contact.number }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ contact.first_name }} {{ contact.last_name }}</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ contact.email }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ contact.state }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ contact.zip }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ contact.created_at }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<Pagination :links="contacts.meta.links" :to="contacts.meta.to" :from="contacts.meta.from" :total="contacts.meta.total" />
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/User/AppLayout.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {PencilAltIcon, TrashIcon} from "@heroicons/vue/outline"
import {ref} from "@vue/reactivity"
import Modal from "../../Jetstream/Modal.vue"
import {Inertia} from "@inertiajs/inertia"
import Pagination from "@/Components/Pagination"

export default {
	components: {
		AppLayout,
		Link,
		PencilAltIcon,
		TrashIcon,
		Modal,
		Pagination,
	},
	props: {
		contacts: Array,
	},
	setup() {
		return {}
	},
}
</script>
