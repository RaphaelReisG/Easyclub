<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';


    const form = useForm({
        name: '',
        cnpj: '',
    });

    const submit = () => {
        //alert("opa");
        form.post(route('empresa.store'));
    };


</script>

<template>
    <Head title="Empresas - Novo" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"><Link class="underline" :href="route('empresa.index')">Empresas</Link> > Novo</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">
                        
                        <p>Preencha o formulario abaixo para adicionar uma nova empresa ao sistema.</p>

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo da Empresa" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="CNPJ" placeholder="CNPJ" name="cnpj" type="text" v-model="form.cnpj" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.cnpj" />
                                <br><br>
                            </template>
                        </formDefault>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>