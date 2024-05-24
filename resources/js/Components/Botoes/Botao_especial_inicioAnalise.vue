<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const formato = ref(true);

const toggleFormato = () => {
    formato.value = !formato.value;
    console.log(formato.value);
};


defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div style="color: green; cursor: pointer;" v-if="formato == true" @click="toggleFormato">
        Iniciar Analise
    </div>
    <div class="inline-block px-1 py-0 relative" v-else>
        <div class="inline-block px-1">
            certeza?
        </div>
        <Link :href="href"
            class="cursor-pointer inline-block px-2 py-1 text-xs font-medium leading-6 text-center text-red-500 uppercase transition bg-transparent border-2 border-red-500 rounded ripple hover:bg-red-100 focus:outline-none">
        Sim
        </Link>
        <div class="cursor-pointer inline-block px-2 py-1 text-xs font-medium leading-6 text-center text-gray-500 uppercase transition bg-transparent border-2 border-gray-500 rounded ripple hover:bg-gray-200 focus:outline-none"
            @click="toggleFormato">Não</div>
    </div>
</template>
