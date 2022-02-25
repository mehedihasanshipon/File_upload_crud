<template>
	<app-layout>
		<!--  -->
		<div class="max-w-xl mx-auto">
			<div class="flex-1 flex gap-2 order-2 lg:order-1"></div>
			<div class="mb-2 lg:mb-0 ml-auto order-1 lg:order-2">
				<div class="flex gap-x-2">
					<!--  -->
					<form @submit.prevent="submit" class="px-2 lg:px-4" enctype="multipart/form-data">
						<div class="space-y-3 lg:space-y-8 divide-y divide-gray-200 py-2 lg:py-6 px-2 lg:px-4 border border-gray-200 rounded-md shadow-sm">
							<div>
								<div>
									<h3 class="text-lg leading-6 font-medium text-gray-900">File Information</h3>
								</div>
								<div class="mt-3 lg:mt-6 grid grid-cols-1 gap-y-2 lg:gap-y-6 gap-x-4 sm:grid-cols-6">
									<div class="sm:col-span-6 space-y-1">
										<Label value="Name" />
										<input v-model="form.name" type="text" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" required placeholder="File Name" />
										<!-- Error message -->
										<InputError :message="form.errors.name" />
									</div>

									<!--  -->
									<div class="sm:col-span-6 flex items-center space-x-2">
										<div class="flex-1 overflow-hidden">
											<input type="file" @change="onFileChange" />
										</div>
									</div>
									<!--  -->
								</div>
							</div>
							<div class="pt-5">
								<div class="flex items-center justify-end gap-4">
									<PrimaryButton :type="submit"> Save </PrimaryButton>
								</div>
							</div>
						</div>
					</form>
					<!--  -->
				</div>
			</div>
		</div>
		<!--  -->
	</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/User/AppLayout.vue"
import {Link, useForm} from "@inertiajs/inertia-vue3"
import {PencilAltIcon, TrashIcon} from "@heroicons/vue/outline"
import {ref} from "@vue/reactivity"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import {Inertia} from "@inertiajs/inertia"

export default {
	components: {
		AppLayout,
		Link,
		PencilAltIcon,
		TrashIcon,
		PrimaryButton,
	},
	props: {},
	setup() {
		let form = useForm({
			name: null,
			file: null,
		})
		function onFileChange(e) {
			let inputFile = e.target.files[0]
			form.file = inputFile
		}

		const submit = () => {
			console.log(form.file)

			form.post(route("import.store"))
		}

		return {
			onFileChange,
			submit,
			form,
		}
	},
}
</script>
