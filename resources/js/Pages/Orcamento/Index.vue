<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import TabelaAccordion_Orcamento from '@/Components/Tabelas/TabelaAccordion_Orcamento.vue';
    import Botao_novo from '@/Components/Botoes/Botao_novo.vue';
    import Paginacao from '@/Components/Paginacao.vue';
    //import Paginacao from '@/Components/Paginacao.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Orçamento - Index" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">Orçamentos</h2>

                
                <Botao_novo v-if="$page.props.auth.user.userable_type === 'App\\Models\\Cliente'" :href="route('orcamento.create')"></Botao_novo>
              
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div class="p-6 text-gray-900">
                        Orçamentos cadastrados no sistema: 

                        <Paginacao :paginacao="$page.props.orcamentos"/>

                        <TabelaAccordion_Orcamento/>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>