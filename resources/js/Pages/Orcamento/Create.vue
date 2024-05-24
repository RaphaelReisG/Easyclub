<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import textAreaNew from '@/Components/forms/inputs/textAreaNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import SelectObject from '@/Components/forms/Selects/SelectObject.vue';

    //const id = $page.props.auth.user.userable_id;

    const id = usePage().props.auth.user.userable_id;

    const form = useForm({
        name: '',
        description: '',
        cliente_id: id,
        tipo_orcamento_id: '',
    });

    const submit = () => {
        //alert("opa");
        form.post(route('orcamento.store'));
    };


</script>

<template>
    <Head title="Orçamento - Novo" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"><Link class="underline" :href="route('orcamento.index')">Orçamentos</Link> > Novo</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Cliente'" class="p-6 text-gray-900">

                    
                        
                        <p>Preencha o formulario abaixo para adicionar um novo orçamento ao sistema.</p>

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <SelectObject rotulo="Tipo de Orçamento" lista="tipoOrcamento" placeholder="Selecione o tipo do orçamento" name="tipo_orcamento_id" v-model="form.tipo_orcamento_id"></SelectObject>
                                <InputError class="mt-2" :message="form.errors.tipo_orcamento_id" />
                                <br>
                                <inputNew rotulo="Nome" placeholder="Nome Completo da Empresa" name="name" type="text"
                                    v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <textAreaNew rotulo="Descrição" placeholder="Descrição" name="description" type="text" v-model="form.description" required></textAreaNew>
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