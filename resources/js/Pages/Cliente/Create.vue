<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import formDefault from '@/Components/forms/formDefault.vue';
import inputNew from '@/Components/forms/inputs/inputNew.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import SelectObject from '@/Components/forms/Selects/SelectObject.vue';


const form = useForm({
    name: '',
    email: '',
    empresa_id: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('cliente.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};


</script>

<template>
    <Head title="Empresa - Novo" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight">
                    <Link class="underline" :href="route('cliente.index')">Clientes</Link> > Novo
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para adicionar um novo cliente ao sistema.</p> {{
                            $page.props.auth.user.userable.empresa_id }}

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text"
                                    v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="E-mail" placeholder="E-mail" name="email" type="email"
                                    v-model="form.email" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.email" />
                                <br><br>
                                <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'">
                                    <SelectObject rotulo="Empresa" lista="empresas" placeholder="Selecione a empresa"
                                        name="empresa_id" v-model="form.empresa_id"></SelectObject>
                                    <InputError class="mt-2" :message="form.errors.empresa_id" />
                                    <br>
                                </div>
                                <div style="display: none;" v-else>
                                    {{ form.empresa_id = $page.props.auth.user.userable.empresa_id }}
                                </div>
                                <inputNew rotulo="Senha" placeholder="Senha" name="password" type="password"
                                    v-model="form.password" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.password" />
                                <br><br>
                                <inputNew rotulo="Confirme a Senha" placeholder="Confirme a Senha"
                                    name="password_confirmation" type="password" v-model="form.password_confirmation"
                                    required></inputNew>
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                <br><br>
                            </template>
                        </formDefault>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>