<template>
    <GuestLayout>
        {{ description }}
    </GuestLayout>

    <Head :title="title" />
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
    status: Number
})

const title = computed(() => {
    return {
        404: '404. Not found',
        403: '403. Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        404: 'That page was not found',
        403: 'You can not access that',
    }[props.status]
})
</script>
