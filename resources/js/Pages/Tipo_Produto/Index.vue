<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import TabelaAccordion_Tipo_Produto from '@/Components/Tabelas/TabelaAccordion_Tipo_Produto.vue';
    import Botao_novo from '@/Components/Botoes/Botao_novo.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Tipo de produto - Index" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">Tipos de Produtos</h2>
                <Botao_novo :href="route('tipo_produto.create')"></Botao_novo>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">
                        Tipos de produtos cadastrados no sistema: 

                        <TabelaAccordion_Tipo_Produto/>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>