<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    paginacao: {
        type: Object,
        required: true,
    },
    ordemPor: {
        type: String,
        required: true,
    },
    rotulo: {
        type: String,
        required: true,
    },
    rota: {
        type: String,
        required: true,
    },
});

const objeto = props.paginacao;
</script>

<template>
    <Link v-if="$page.props.order_by == ordemPor && $page.props.direction == 'asc'"
        :href="route(rota, { order_by: ordemPor, direction: 'desc' })"
        class="inline-flex items-center space-x-1">
    {{ rotulo }}
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
            d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z" />
        <path
            d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z" />
    </svg>
    </Link>
    <Link v-else-if="$page.props.order_by == ordemPor && $page.props.direction == 'desc'"
        :href="route(rota, { order_by: ordemPor, direction: 'asc' })"
        class="inline-flex items-center space-x-1">
        {{ rotulo }}
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-up-alt"
        viewBox="0 0 16 16">
        <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645z" />
        <path fill-rule="evenodd"
            d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371zm1.57-.785L11 9.688h-.047l-.652 2.156z" />
        <path
            d="M4.5 13.5a.5.5 0 0 1-1 0V3.707L2.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L4.5 3.707z" />
    </svg>
    </Link>
    <Link v-else :href="route(rota, { order_by: ordemPor, direction: 'asc' })">
        {{ rotulo }}
    </Link>
</template>
