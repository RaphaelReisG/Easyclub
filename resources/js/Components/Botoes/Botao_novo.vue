<script setup>
    import { Link } from '@inertiajs/vue3';
    defineProps({
        href: {
            type: String,
            required: true,
        },
    });
</script>

<template>
    <Link
        :href="href"
        class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none ml-10"
    >
        Novo
    </Link>
</template>
