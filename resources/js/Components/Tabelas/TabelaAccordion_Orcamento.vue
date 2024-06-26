<script setup>


import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { Link } from '@inertiajs/vue3';
import Botao_especial_inicioAnalise from '@/Components/Botoes/Botao_especial_inicioAnalise.vue';
import Botao_editar from '@/Components/Botoes/Botao_editar.vue';
import Botao_deletar from '@/Components/Botoes/Botao_deletar.vue';

onMounted(() => {
    initFlowbite();
})

function calculaSla(dataInicio, sla) {
    let novaData = new Date(dataInicio);
    novaData.setDate(novaData.getDate() + sla);
    return novaData.toLocaleDateString('pt-BR'); // Formato 'DD/MM/YYYY'
}


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
                                    Data - Solicitação
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Nome
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Inicio de Analise
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Previsão
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'">
                                    Empresa
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Opções
                                </th>
                            </tr>
                        </thead>
                        <tbody data-accordion="collapse" v-for="(obj, index) in  $page.props.orcamentos.data ">
                            <tr v-bind:id="'accordion-collapse-heading-Administrador' + index"
                                class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                                v-bind:data-accordion-target="'#accordion-collapse-body-Administrador' + index"
                                aria-expanded="false"
                                v-bind:aria-controls="'accordion-collapse-body-Administrador' + index"> 

                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ new
                                    Date(obj.created_at).toLocaleString() }}</td>
                                <td>{{ obj.name }}</td>
                                <td>
                                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Cliente'">
                                        {{ obj.data_inicio_analise ? new Date(obj.data_inicio_analise).toLocaleString() :
                                            'Pendente' }}
                                    </div>
                                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'">
                                        <Botao_especial_inicioAnalise
                                            v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador' && obj.data_inicio_analise === null"
                                            :href="route('orcamento.updateInicioAnalise', { id: obj.id })">
                                        </Botao_especial_inicioAnalise>
                                        {{ obj.data_inicio_analise ? new Date(obj.data_inicio_analise).toLocaleString() : ''
                                        }}
                                    </div>
                                </td>
                                <td>
                                    {{ obj.data_inicio_analise ? calculaSla(obj.data_inicio_analise, obj.cliente.empresa.time_sla) : 'Pendente' }}
                                </td>
                                <td v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador' && obj.data_inicio_analise!== null && obj.orcamento_status == null" > <Link style="color: green; cursor: pointer;"  :href="route('orcamento.carregaPageUpdateOrcamento', { id: obj.id })">Finalizar</Link> </td>
                                <td v-else-if="obj.orcamento_status !== null"> {{ obj.orcamento_status ? "Aprovado" : 'Negado' }}</td>
                                <td v-else>{{ obj.orcamento_status ? obj.orcamento_status : 'Pendente' }}</td>

                                <td v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'">{{ obj.cliente.empresa.name }}</td>
                                <td>
                                    <Botao_editar v-if="!obj.data_inicio_analise && $page.props.auth.user.userable_type === 'App\\Models\\Cliente'" :href="route('orcamento.edit', { id: obj.id })"></Botao_editar>
                                    <Botao_deletar v-if="!obj.data_inicio_analise" destino="orcamento.destroy" :deleteId="obj.id"></Botao_deletar>
                                </td>
                            </tr>
                            <tr class="hidden bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                                v-bind:id="'accordion-collapse-body-Administrador' + index"
                                v-bind:aria-labelledby="'accordion-collapse-heading-Administrador' + index">
                                <td colspan="3" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                   
                                    Usuario que solicitou: {{ obj.cliente.name }} | {{ obj.cliente.empresa.name }} <br>
                                    Analista que iniciou: {{ obj.data_inicio_analise ? obj.administrador.name : 'Pendente' }} <br>
                                    Descrição: {{ obj.description }} <br>
                                    Data de encerramento: {{ obj.data_encerramento ? new
                                        Date(obj.data_encerramento).toLocaleString() : 'Pendente' }} <br>
                                    Observação da resposta: {{ obj.response_observation }} <br>
                                    Itens:<br>
                                    <ul>
                                        <li v-for="(obj2, index2) in  obj.item_orcamentos ">Nome: {{ obj2.name}} | Quantidade: {{ obj2.quantity }} | {{ obj2.tipo_orcamento.name }} </li>
                                    </ul>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

