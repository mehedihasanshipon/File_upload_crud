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
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Uploaded</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Processed</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(file, index) in fileLists.data" :key="index" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
									<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
										{{ file.file_name }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ file.total_uploaded }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ file.total_processed }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-left font-medium">
										<button @click="showGroup(file)" class="bg-cyan-400 text-white px-4 py-2 rounded-md">Group</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<Pagination :links="fileLists.meta.links" :to="fileLists.meta.to" :from="fileLists.meta.from" :total="fileLists.meta.total" />
				</div>
			</div>
		</div>
		<Modal :show="showGroupModal" @close="showGroupModal = false">
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
						<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200">
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group Name</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Show</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(file, index) in groups" :key="index" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
										<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
											{{ file.name }}
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
											{{ file.total_contact }}
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
											<a :href="route('import.contactList', file.id)" target="_blank" class="bg-cyan-400 text-white hover:bg-cyan-600 rounded-md px-6 py-2 whitespace-nowrap text-sm text-left font-medium"> Show </a>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="border border-gray-200 bg-gray-50 p-4 text-right">
								<button @click="showGroupModal = false" class="bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</Modal>
	</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/User/AppLayout.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {PencilAltIcon, TrashIcon} from "@heroicons/vue/outline"
import {ref} from "@vue/reactivity"
import Modal from "../../Jetstream/Modal.vue"
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
		fileLists: Array,
	},
	setup() {
		let form = ref({
			file: null,
		})

		let groups = ref([])

		let showGroupModal = ref(false)

		function showGroup(file) {
			showGroupModal.value = !showGroupModal.value
			axios.get(`group-list/${file.id}`).then((res) => {
				groups.value = res.data.groups
			})
		}

		return {
			showGroup,
			showGroupModal,
			groups,
		}
	},
}
</script>
