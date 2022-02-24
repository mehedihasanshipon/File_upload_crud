<template>
	<app-layout>
		<div class="w-full lg:w-3/5 mx-auto space-y-3 lg:space-y-6 bg-white rounded-md pb-3 lg:pb-6">
			<!-- User Information Form -->
			<form @submit.prevent="submit" class="px-2 lg:px-4">
				<div class="space-y-3 lg:space-y-8 divide-y divide-gray-200 py-2 lg:py-6 px-2 lg:px-4 border border-gray-200 rounded-md shadow-sm">
					<div>
						<div>
							<h3 class="text-lg leading-6 font-medium text-gray-900">Users Information</h3>
						</div>
						<div class="mt-3 lg:mt-6 grid grid-cols-1 gap-y-2 lg:gap-y-6 gap-x-4 sm:grid-cols-6">
							<div class="sm:col-span-6 space-y-1">
								<Label value="Name" />
								<input v-model="form.name" type="text" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.name" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Email" />
								<input v-model="form.email" type="email" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.email" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Role" />
								<select v-model="form.role_id" id="types" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
									<option v-for="(role, index) in roles" :value="role.id" :key="index" class="capitalize">{{ role.name }}</option>
								</select>

								<InputError :message="form.errors.role_id" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Password" />
								<input v-model="form.password" type="password" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.password" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Confirm Password" />
								<input v-model="form.password_confirmation" type="password" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.password_confirmation" />
							</div>
						</div>
					</div>
					<div class="pt-5">
						<div class="flex items-center justify-end gap-4">
							<PrimaryButton :type="submit"> Save </PrimaryButton>
						</div>
					</div>
				</div>
			</form>
		</div>
	</app-layout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import {useForm} from "@inertiajs/inertia-vue3"
import AppLayout from "../../Layouts/Admin/AppLayout.vue"
import Label from "@/Jetstream/Label.vue"
import InputError from "@/Jetstream/InputError.vue"

export default {
	name: "Edit",
	components: {
		PrimaryButton,
		SecondaryButton,
		AppLayout,
		Label,
		InputError,
	},
	props: {
		roles: Array,
		user: Object,
	},
	setup(props) {
		const form = useForm({
			_method: "put",
			name: props.user.data.name,
			email: props.user.data.email,
			role_id: props.user.data.role_id,
			password: null,
			password_confirmation: null,
		})

		const submit = () => {
			form.post(route("admin.dashboard.update", props.user.data.id), {
				preserveScroll: true,
				preserveState: true,
				onSuccess: () => form.reset("name", "email", "role_id", "password", "password_confirmation"),
			})
		}

		return {
			submit,
			form,
		}
	},
}
</script>
