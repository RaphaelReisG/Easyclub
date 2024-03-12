<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import textAreaNew from '@/Components/forms/inputs/textAreaNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import SelectObject from '@/Components/forms/Selects/SelectObject.vue';

    const produto = usePage().props.produto;
    

    const form = useForm({
        name: produto.name,
        description: produto.description,
        cost_price: produto.cost_price,
        sale_price: produto.sale_price,
        fornecedor_id: produto.fornecedor_id,
        tipo_produto_id: produto.tipo_produto_id,
    });

    const submit = () => {
        var t = produto.id
        //alert("opa"+t);
        form.put(route('produto.update', {id: t}));
    };
</script>

<template>
    <Head title="Produto - Alterar" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"> <Link class="underline" :href="route('produto.index')">Produtos</Link> > Editar</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para alterar os atributos de um produto no sistema.</p>

                        <formDefault @submit.prevent="submit" method="PUT">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <textAreaNew rotulo="Descrição" placeholder="Descrição" name="description" type="text" v-model="form.description" required></textAreaNew>
                                <InputError class="mt-2" :message="form.errors.description" />
                                <br><br>
                                <inputNew rotulo="Preço de Custo" placeholder="Preço de custo" name="cost_price" type="number" v-model="form.cost_price" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.cost_price" />
                                <br><br>
                                <inputNew rotulo="Preço de Venda" placeholder="Preço de venda" name="sale_price" type="number" v-model="form.sale_price" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.sale_price" />
                                <br><br>
                                <SelectObject rotulo="Fornecedor" lista="fornecedores" placeholder="Selecione o fornecedor" name="fornecedor_id" v-model="form.fornecedor_id"></SelectObject>
                                <InputError class="mt-2" :message="form.errors.fornecedor_id" />
                                <br>
                                <SelectObject rotulo="Tipo de Produto" lista="tipo_produtos" placeholder="Selecione o tipo do produto" name="tipo_produto_id" v-model="form.tipo_produto_id"></SelectObject>
                                <InputError class="mt-2" :message="form.errors.tipo_produto_id" />
                                <br>
                            </template>
                        </formDefault>

                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>