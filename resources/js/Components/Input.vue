<template>
    <input class="border-gray-100 focus:border-cyan-100 focus:ring-0 rounded-md text-sm text-gray-700 h-10 placeholder-gray-500 placeholder-opacity-50" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    props: ['modelValue'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
})
</script>
