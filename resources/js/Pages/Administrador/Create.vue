<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import TabelaAccordion from '@/Components/TabelaAccordion.vue';
    import Botao_novo from '@/Components/Botoes/Botao_novo.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">Administradores / Novo</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">
                        
                        

                        add aki um adm

                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>