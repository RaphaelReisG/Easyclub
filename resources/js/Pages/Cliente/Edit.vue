<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import SelectObject from '@/Components/forms/Selects/SelectObject.vue';

    const cliente = usePage().props.cliente;
    

    const form = useForm({ 
        name: cliente.name,
        email: cliente.user.email,
        empresa_id: cliente.empresa_id,
    });

    const submit = () => {
        var t = cliente.id
        //alert("opa"+t);
        form.put(route('cliente.update', {id: t}));
    };
</script>

<template>
    <Head title="Cliente - Alterar" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"> <Link class="underline" :href="route('cliente.index')">Clientes</Link> > Editar</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type
                     === 'App\\Models\\Administrador'" class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para alterar os atributos de um cliente no sistema.</p>

                        <formDefault @submit.prevent="submit" method="PUT">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="E-mail" placeholder="E-mail" name="email" type="email" v-model="form.email" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.email" />
                                <br><br>
                                <SelectObject rotulo="Empresa" lista="empresas" placeholder="Selecione a empresa" name="empresa_id" v-model="form.empresa_id"></SelectObject>
                                <InputError class="mt-2" :message="form.errors.empresa_id" />
                                <br>
                            </template>
                        </formDefault>

                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>