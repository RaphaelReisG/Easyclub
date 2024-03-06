<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';

    const administrador = usePage().props.administrador;
    

    const form = useForm({
        name: administrador.name,
        email: administrador.user.email,
    });

    const submit = () => {
        var t = administrador.id
        //alert("opa"+t);
        form.put(route('administrador.update', {id: t}));
    };
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"> <Link class="underline" :href="route('administrador.index')">Administradores</Link> > Editar</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para alterar os atributos de um administrador no sistema.</p>

                        <formDefault @submit.prevent="submit" method="PUT">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="E-mail" placeholder="E-mail" name="email" type="email" v-model="form.email" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.email" />
                                <br><br>
                            </template>
                        </formDefault>

                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>