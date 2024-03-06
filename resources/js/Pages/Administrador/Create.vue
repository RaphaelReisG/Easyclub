<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';


    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        alert("opa");
        form.post(route('administrador.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"><Link class="underline" :href="route('administrador.index')">Administradores</Link> > Novo</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">
                        
                        <p>Preencha o formulario abaixo para adicionar um novo administrador ao sistema.</p>

                        <formDefault @submit.prevent="submit" method="POST">
                            <template #content>
                                <inputNew rotulo="Nome" placeholder="Nome Completo" name="name" type="text" v-model="form.name" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.name" />
                                <br><br>
                                <inputNew rotulo="E-mail" placeholder="E-mail" name="email" type="email" v-model="form.email" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.email" />
                                <br><br>
                                <inputNew rotulo="Senha" placeholder="Senha" name="password" type="password" v-model="form.password" required></inputNew>
                                <InputError class="mt-2" :message="form.errors.password" />
                                <br><br>
                                <inputNew rotulo="Confirme a Senha" placeholder="Confirme a Senha" name="password_confirmation" type="password" v-model="form.password_confirmation" required></inputNew>
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