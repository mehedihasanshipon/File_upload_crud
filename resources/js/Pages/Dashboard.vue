<template>
	<app-layout>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<h1 class="text-red-600 text-xl">User Panel</h1>
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
import {defineComponent} from "vue"
import AppLayout from "@/Layouts/User/AppLayout.vue"
import Welcome from "@/Jetstream/Welcome.vue"

export default defineComponent({
	components: {
		AppLayout,
		Welcome,
	},
})
</script>
