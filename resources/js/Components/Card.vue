<template>
	<div class="sm:px-4 lg:px-4 py-4">
		<!-- Card -->
		<div class="overflow-hidden shadow rounded-lg bg-gray-100">
			<div class="p-5">
				<div class="flex items-center">
					<div class="flex-shrink-0">
						<PencilAltIcon class="h-6 w-6 text-gray-500" aria-hidden="true" />
					</div>
					<div class="ml-5 w-0 flex-1">
						<dl>
							<dt class="text-sm font-medium text-gray-600 truncate">{{ title }}</dt>
							<dd>
								<div class="text-lg font-medium text-gray-900">{{ count }}</div>
							</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {PencilAltIcon, TrashIcon} from "@heroicons/vue/outline"

export default {
	components: {
		PencilAltIcon,
		TrashIcon,
	},
	props: {
		title: String,
		count: String,
	},
	setup() {
		return {}
	},
}
</script>
