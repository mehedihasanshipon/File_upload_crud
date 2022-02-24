<template>
    <div class="bg-transparent py-2 lg:py-3 mt-4 flex items-center justify-between border-t border-gray-200">

        <div class="flex-1 sm:flex sm:items-center sm:justify-between space-y-2">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium"> {{ from }} </span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium"> {{ to }} </span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium"> {{ total }} </span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex gap-1 rounded-md shadow-sm bg-white p-1" aria-label="Pagination">
                    <Link v-for="(link, index) in links" :key="index" :href="link.url"
                          class="border border-transparent inline-flex items-center px-3 lg:px-4 py-1 lg:py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-primary rounded-md"
                          :class="[link.active ? 'border-primary':'border-gray-200']">
                        <div class="inline-flex justify-center" v-if="link.label.includes('Previous')">
                            <ArrowNarrowLeftIcon class="h-5 w-5 mx-auto text-gray-400" aria-hidden="true"/>
                        </div>
                        <div class="inline-flex justify-center" v-else-if="link.label.includes('Next')">
                            <ArrowNarrowRightIcon class="h-5 w-5 mx-auto text-gray-400" aria-hidden="true"/>
                        </div>
                        <div
                            v-else
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center text-sm font-medium">
                            {{ link.label }}
                        </div>
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import {ChevronLeftIcon, ChevronRightIcon, ArrowNarrowLeftIcon, ArrowNarrowRightIcon} from '@heroicons/vue/solid';
import {Link} from "@inertiajs/inertia-vue3"

export default {
    components: {
        ChevronLeftIcon,
        ChevronRightIcon,
        Link,
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon
    },
    props: {
        links: Array,
        to: Object,
        total: Object,
        from: Object
    },
}
</script>
