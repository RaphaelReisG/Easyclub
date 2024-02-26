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
    <li>
        <Link
            :href="href"
            class="dropdown-item"
        >
            <slot />
        </Link>
    </li>
</template> 
