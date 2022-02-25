<template>
	<app-layout>
		<div class="container mx-auto">
			<div class="overflow-hidden sm:rounded-lg">
				<div class="mt-2 grid grid-cols-1 gap-0 sm:grid-cols-2 lg:grid-cols-3">
					<Card title="Total Files" :count="totalFiles" />
					<Card title=" Total Groups" :count="totalGroups" />
					<Card title="Total Contacts" :count="totalContacts" />
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
import {defineComponent} from "vue"
import AppLayout from "@/Layouts/User/AppLayout.vue"
import Welcome from "@/Jetstream/Welcome.vue"
import Card from "../Components/Card.vue"

export default defineComponent({
	components: {
		AppLayout,
		Welcome,
		Card,
	},
	props: {
		totalFiles: Object,
		totalGroups: Object,
		totalContacts: Object,
	},
})
</script>
