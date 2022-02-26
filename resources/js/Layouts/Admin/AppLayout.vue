<template>
	<div>
		<TransitionRoot as="template" :show="sidebarOpen">
			<Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
				<TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
					<DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
				</TransitionChild>
				<TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
					<div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800">
						<TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
							<div class="absolute top-0 right-0 -mr-12 pt-2">
								<button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
									<span class="sr-only">Close sidebar</span>
									<XIcon class="h-6 w-6 text-white" aria-hidden="true" />
								</button>
							</div>
						</TransitionChild>
						<div class="flex-shrink-0 flex items-center px-4">
							<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
						</div>
						<div class="mt-5 flex-1 h-0 overflow-y-auto">
							<nav class="px-2 space-y-1">
								<a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
									<component :is="item.icon" :class="[item.current ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
									{{ item.name }}
								</a>
							</nav>
						</div>
					</div>
				</TransitionChild>
				<div class="flex-shrink-0 w-14" aria-hidden="true">
					<!-- Dummy element to force sidebar to shrink to fit close icon -->
				</div>
			</Dialog>
		</TransitionRoot>

		<!-- Static sidebar for desktop -->
		<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
			<!-- Sidebar component, swap this element with another sidebar if you like -->
			<div class="flex-1 flex flex-col min-h-0 bg-gray-800">
				<div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
					<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
				</div>
				<div class="flex-1 flex flex-col overflow-y-auto">
					<nav class="flex-1 px-2 py-4 space-y-1">
						<Link :href="route('admin.dashboard.index')" :class="[4 % 2 == 0 ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']"> Dashboard </Link>
					</nav>
				</div>
			</div>
		</div>
		<div class="md:pl-64 flex flex-col">
			<div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
				<button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
					<span class="sr-only">Open sidebar</span>
					<MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
				</button>
				<div class="flex-1 px-4 flex justify-between">
					<div class="flex-1 flex"></div>
					<div class="ml-4 flex items-center md:ml-6">
						<button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
							<span class="sr-only">View notifications</span>
							<BellIcon class="h-6 w-6" aria-hidden="true" />
						</button>

						<!-- Profile dropdown -->
						<Menu as="div" class="ml-3 relative">
							<div>
								<MenuButton class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
									<span class="sr-only">Open user menu</span>
									<img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
								</MenuButton>
							</div>
							<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
								<MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
									<Link :href="route('logout')" method="post" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Sign out </Link>
								</MenuItems>
							</transition>
						</Menu>
					</div>
				</div>
			</div>

			<main class="flex-1">
				<div class="px-6 py-6">
					<slot></slot>
				</div>
			</main>
		</div>
	</div>
</template>

<script>
import {ref} from "vue"
import {Dialog, DialogOverlay, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot} from "@headlessui/vue"
import {BellIcon, HomeIcon, MenuAlt2Icon, XIcon} from "@heroicons/vue/outline"
import {SearchIcon} from "@heroicons/vue/solid"
import {Link} from "@inertiajs/inertia-vue3"

const navigation = [{name: "Dashboard", href: "#", icon: HomeIcon, current: true}]

export default {
	components: {
		Dialog,
		DialogOverlay,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		TransitionChild,
		TransitionRoot,
		BellIcon,
		MenuAlt2Icon,
		SearchIcon,
		XIcon,
		Link,
	},
	setup() {
		const sidebarOpen = ref(false)

		return {
			navigation,
			sidebarOpen,
		}
	},
}
</script>
