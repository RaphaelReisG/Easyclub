<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'nav-link active'
        : 'nav-link'
);
</script>

<template>
    <li class="nav-item">
        
        <Link :href="href" :class="classes">
            <slot />
        </Link>
    </li>
</template>
