<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import formDefault from '@/Components/forms/formDefault.vue';
import inputNew from '@/Components/forms/inputs/inputNew.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';


const form = useForm({
    name: '',
    cnpj: '',
    time_sla: 30,
});

const submit = () => {
    if(validarCNPJ(form.cnpj)){
        console.log("correto")
        form.post(route('empresa.store'));
    }
    else{
        form.errors.cnpj = "Digite um CNPJ valido"
        console.log("errado")
    }
    //alert("opa");
    //form.post(route('empresa.store'));
};

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]/g, '');

    if (cnpj.length !== 14) {
        return false;
    }

    if (/^(\d)\1+$/.test(cnpj)) {
        return false;
    }

    let soma = 0;
    let peso = 2;
    for (let i = 11; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }

    const digitoVerificador1 = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (parseInt(cnpj.charAt(12)) !== digitoVerificador1) {
        return false;
    }

    soma = 0;
    peso = 2;
    for (let i = 12; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }

    const digitoVerificador2 = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (parseInt(cnpj.charAt(13)) !== digitoVerificador2) {
        return false;
    }

    return true;
}


</script>

<template>
    <Head title="Empresas - Novo" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">
                    <Link class="underline" :href="route('empresa.index')">Empresas</Link> > Novo
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'"
                        class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para adicionar uma nova empresa ao sistema.</p>

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo da Empresa" name="name" type="text"
                                    v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="Tempo de SLA" placeholder="Tempo de SLA em dias" name="time_sla" type="text"
                                    v-model="form.time_sla" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.time_sla" />
                                <br><br>
                                <inputNew rotulo="CNPJ" placeholder="CNPJ" name="cnpj" type="text" v-model="form.cnpj"
                                    required></inputNew>
                                <InputError class="mt-2" :message="form.errors.cnpj" />
                                <br><br>
                            </template>
                        </formDefault>
                    </div>
                </div>
        </div>
    </div>
</AuthenticatedLayout></template>