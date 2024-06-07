<script setup>
import { ref, reactive, onMounted } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import formDefault from '@/Components/forms/formDefault.vue';
import inputNew from '@/Components/forms/inputs/inputNew.vue';
import Botao_add from '@/Components/Botoes/Botao_add.vue';
import textAreaNew from '@/Components/forms/inputs/textAreaNew.vue';
import InputError from '@/Components/InputError.vue';
import SelectObject from '@/Components/forms/Selects/SelectObject.vue';
import { initFlowbite } from 'flowbite';

onMounted(() => {
    initFlowbite();
});

const id = usePage().props.auth.user.userable_id;

const form = useForm({
    name: '',
    description: '',
    cliente_id: id,
    tipo_orcamento_id: '',
    itens: [],
});

const dataItem = reactive({
    name: '',
    description: '',
    quantity: 1,
    product_code: '',
    manufacturer_name: '',
    tipo_orcamento_id: '',
});

const addItem = () => {
    // Adiciona uma cópia do objeto dataItem ao array form.itens
    if (dataItem.name !== '') {
        if (dataItem.description !== '') {
            if (dataItem.quantity > 0) {
                if (dataItem.tipo_orcamento_id !== '') {
                    if (dataItem.manufacturer_name !== '') {
                        form.itens.push({ ...dataItem });

                        // Reseta os campos do objeto dataItem
                        dataItem.name = '';
                        dataItem.description = '';
                        dataItem.quantity = 1;
                        dataItem.product_code = '';
                        dataItem.manufacturer_name = '';
                        dataItem.tipo_orcamento_id = '';
                    }
                    else {
                        alert("O fabricante é obrigatório, caso não tenha uma preferência, escrever indiferente.");
                    }
                }
                else {
                    alert("Selecione um tipo de item.");
                }
            }
            else {
                alert("Quantidade do item deve ser maior que zero.");
            }
        }
        else {
            alert("A descrição do item é obrigatória.");
        }
    }
    else {
        alert("Nome do Item é obrigatório");
    }

};

const removeItem = (index) => {
    form.itens.splice(index, 1);
};


const submit = () => {
    if (form.itens.length > 0) {
        form.post(route('orcamento.store'));
    } else {
        alert("Adicione pelo menos um item ao orçamento antes de enviar.");
    }
};

const editingIndex = ref(null);
const editingField = ref(null);

const startEdit = (index, field) => {
    editingIndex.value = index;
    editingField.value = field;
};

const stopEdit = () => {
    editingIndex.value = null;
    editingField.value = null;
};

</script>

<template>
    <Head title="Orçamento - Novo" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">
                    <Link class="underline" :href="route('orcamento.index')">Orçamentos</Link> > Novo
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    

                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Cliente'" class="p-6 text-gray-900">
                        <p>Preencha o formulario abaixo para adicionar um novo orçamento ao sistema.</p>

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <inputNew rotulo="Nome *" placeholder="Nome" name="name" type="text" v-model="form.name"
                                    required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <textAreaNew rotulo="Descrição *" placeholder="Descrição" name="description" type="text"
                                    v-model="form.description" required></textAreaNew>
                                <InputError class="mt-2" :message="form.errors.description" />
                                <br><br>
                            </template>
                        </formDefault>

                        <div>
                            <h3>Adicionar Item:</h3>
                            <div class="flex space-x-4">
                                <Botao_add @click="addItem" />
                                <SelectObject rotulo="" lista="tipoOrcamento" placeholder="Selecione o tipo do orçamento"
                                    name="tipo_orcamento_id" v-model="dataItem.tipo_orcamento_id"></SelectObject>
                                <inputNew rotulo="" placeholder="Nome do Item" name="nameItem" type="text"
                                    v-model="dataItem.name" required></inputNew>
                                <inputNew style="max-width: 20px;" rotulo="" placeholder="Quantidade" name="QuanttityItem"
                                    type="number" v-model="dataItem.quantity" required></inputNew>
                                <inputNew rotulo="" placeholder="Código do Item" name="codeItem" type="text"
                                    v-model="dataItem.product_code"></inputNew>
                                <inputNew rotulo="" placeholder="Fabricante do Item" name="manufacturer_nameItem"
                                    type="text" v-model="dataItem.manufacturer_name"></inputNew>
                            </div>
                            <textAreaNew rotulo="" placeholder="Descrição do Item" name="DecriptionItem" type="text"
                                v-model="dataItem.description"></textAreaNew>
                        </div>
                        <InputError class="mt-2" :message="form.errors.itens" />

                        <div>
                            <h3>Itens no orçamento:</h3>
                            <div class="flex flex-col" v-if="form.itens.length > 0">
                                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full">
                                                <thead class="bg-gray-200 border-b">
                                                    <tr>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Quantidade
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Nome
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Codigo
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Fabricante
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Opções
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody data-accordion="collapse" v-for="(obj, index) in form.itens"
                                                    :key="index">
                                                    <tr
                                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                        <td @dblclick="startEdit(index, 'quantity')">

                                                            <span
                                                                v-show="editingIndex !== index || editingField !== 'quantity'">{{
                                                                    obj.quantity }}</span>
                                                            <input
                                                                v-show="editingIndex === index && editingField === 'quantity'"
                                                                type="number" v-model="obj.quantity" @blur="stopEdit" />
                                                                
                                                        </td>
                                                        <td @dblclick="startEdit(index, 'name')">
                                                            <span
                                                                v-show="editingIndex !== index || editingField !== 'name'">{{
                                                                    obj.name }}</span>
                                                            <input
                                                                v-show="editingIndex === index && editingField === 'name'"
                                                                type="text" v-model="obj.name" @blur="stopEdit" />
                                                        </td>
                                                        <td @dblclick="startEdit(index, 'product_code')">
                                                            <span
                                                                v-show="editingIndex !== index || editingField !== 'product_code'">{{
                                                                    obj.product_code }}</span>
                                                            <input
                                                                v-show="editingIndex === index && editingField === 'product_code'"
                                                                type="text" v-model="obj.product_code" @blur="stopEdit" />
                                                        </td>
                                                        <td @dblclick="startEdit(index, 'manufacturer_name')">
                                                            <span
                                                                v-show="editingIndex !== index || editingField !== 'manufacturer_name'">{{
                                                                    obj.manufacturer_name }}</span>
                                                            <input
                                                                v-show="editingIndex === index && editingField === 'manufacturer_name'"
                                                                type="text" v-model="obj.manufacturer_name"
                                                                @blur="stopEdit" />
                                                        </td>
                                                        <td>
                                                            <button @click="removeItem(index)"
                                                                class="text-red-500">Remover</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="hidden bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                                                        v-bind:id="'accordion-collapse-body-Administrador' + index"
                                                        v-bind:aria-labelledby="'accordion-collapse-heading-Administrador' + index">
                                                        <td colspan="5"
                                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                            Descrição: {{ obj.description }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
