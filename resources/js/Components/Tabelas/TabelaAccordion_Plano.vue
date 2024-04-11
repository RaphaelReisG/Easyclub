<script setup>


    import { onMounted } from 'vue'
    import { initFlowbite } from 'flowbite'

    import Botao_editar from '@/Components/Botoes/Botao_editar.vue';
    import Botao_deletar from '@/Components/Botoes/Botao_deletar.vue';

    onMounted(() => {
        initFlowbite();
    })

   
</script>


<template>
    <!-- component -->
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Nome
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Data de Criação
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Opções
                                </th>
                            </tr>
                        </thead>
                        <tbody data-accordion="collapse" v-for="(obj, index) in  $page.props.planos ">
                            <tr 
                                v-bind:id="'accordion-collapse-heading-Administrador' + index"
                                class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100" 
                                v-bind:data-accordion-target="'#accordion-collapse-body-Administrador' + index"
                                aria-expanded="false" 
                                v-bind:aria-controls="'accordion-collapse-body-Administrador' + index"
                            >
                                <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" scope="row">{{ index+1 }}</th>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ obj.name }}</td>
                                <td>{{ new Date(obj.created_at).toLocaleString() }}</td>
                                <td>
                                    <Botao_editar :href="route('plano.edit' , {id: obj.id})"></Botao_editar>
                                    <Botao_deletar destino="plano.destroy" :deleteId="obj.id"></Botao_deletar>
                                </td>
                            </tr>
                            <tr class="hidden bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"  
                                v-bind:id="'accordion-collapse-body-Administrador' + index" 
                                v-bind:aria-labelledby="'accordion-collapse-heading-Administrador' + index"
                            >
                                <td colspan="7" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap" > 
                                    <p>Descrição: {{ obj.description }}</p>
                                    Produtos:
                                    <p v-for="(obj2, index2) in  obj.produtos "> - {{ obj2.name }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

