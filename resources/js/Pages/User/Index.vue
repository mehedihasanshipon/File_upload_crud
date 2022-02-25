<template>
	<app-layout>
		<!--  -->
		<div class="flex flex-col lg:flex-row justify-between lg:items-center my-2 lg:my-4">
			<div class="flex-1 flex gap-2 order-2 lg:order-1"></div>
			<div class="mb-2 lg:mb-0 ml-auto order-1 lg:order-2">
				<div class="flex gap-x-2">
					<Link :href="route('admin.dashboard.create')" class="h-8 lg:h-10 inline-flex items-center px-3 lg:px-4 py-2 bg-cyan-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-600 active:bg-cyan-600 focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150"> Create </Link>
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
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
									<th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(user, index) in users.data" :key="index" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
									<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
										{{ user.name }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ user.email }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										<Switch v-model="user.status" @click="disableUsers(user)" class="flex-shrink-0 group relative rounded-full inline-flex items-center justify-center h-5 w-10 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-green-700">
											<span class="sr-only">Use setting</span>
											<span aria-hidden="true" class="pointer-events-none absolute bg-white w-full h-full rounded-md" />
											<span aria-hidden="true" :class="[user.status ? 'bg-indigo-600' : 'bg-gray-200', 'pointer-events-none absolute h-4 w-9 mx-auto rounded-full transition-colors ease-in-out duration-200']" />
											<span aria-hidden="true" :class="[user.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none absolute left-0 inline-block h-5 w-5 border border-gray-200 rounded-full bg-white shadow transform ring-0 transition-transform ease-in-out duration-200']" />
										</Switch>
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ user.role.name }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
										{{ user.created_at }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
										<div class="flex justify-center space-x-2 text-left">
											<Link :href="route('admin.dashboard.edit', user.id)">
												<PencilAltIcon class="h-5 w-5 text-primary" />
											</Link>
											<Link :href="route('admin.dashboard.destroy', user.id)" method="delete">
												<TrashIcon class="h-5 w-5 text-red-500" />
											</Link>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<Pagination :links="users.meta.links" :to="users.meta.to" :from="users.meta.from" :total="users.meta.total" />
				</div>
			</div>
		</div>
	</app-layout>
	<Notification />
</template>

<script>
import AppLayout from "../../Layouts/Admin/AppLayout.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {Switch} from "@headlessui/vue"
import {PencilAltIcon, TrashIcon} from "@heroicons/vue/outline"
import {Inertia} from "@inertiajs/inertia"
import Notification from "@/Components/Notification.vue"
import Pagination from "@/Components/Pagination"

export default {
	components: {
		AppLayout,
		Link,
		PencilAltIcon,
		TrashIcon,
		Switch,
		Notification,
		Pagination,
	},
	props: {
		users: Object,
	},
	setup() {
		const disableUsers = (user) => {
			Inertia.post(
				route("admin.users.ban", user.id),
				{
					status: user.status,
				},
				{
					preserveState: true,
					preserveScroll: true,
				}
			)
		}
		return {
			disableUsers,
		}
	},
}
</script>
