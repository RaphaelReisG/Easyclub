<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';

    const tipo_produto = usePage().props.tipo_Produto;
    

    const form = useForm({
        name: tipo_produto.name,
        description: tipo_produto.description,
    });

    const submit = () => {
        var t = tipo_produto.id
        //alert("opa"+t);
        form.put(route('tipo_produto.update', {id: t}));
    };
</script>

<template>
    <Head title="Tipo de produto - Alterar" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"> <Link class="underline" :href="route('tipo_produto.index')">Tipos de Produtos</Link> > Editar</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para alterar os atributos de um tipo de produto no sistema.</p>

                        <formDefault @submit.prevent="submit" method="PUT">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="Descrição" placeholder="Descrição" name="description" type="text" v-model="form.description" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.description" />
                                <br><br>
                            </template>
                        </formDefault>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>