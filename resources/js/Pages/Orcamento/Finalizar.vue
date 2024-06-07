<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import formDefault from '@/Components/forms/formDefault.vue';
    import inputNew from '@/Components/forms/inputs/inputNew.vue';
    import textAreaNew from '@/Components/forms/inputs/textAreaNew.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';

    const orcamento = usePage().props.orcamento;
    

    const form = useForm({
        orcamento_status: false,
        response_observation: '',
    });

    const submit = () => {
        var t = orcamento.id
        //alert("opa"+t);
        form.put(route('orcamento.updateOrcamentoStatus', {id: t}));
    };
</script>

<template>
    <Head title="Orçamento - Finalizar" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight"> <Link class="underline" :href="route('orcamento.index')">Orçamentos</Link> > Finalizar</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div v-if="$page.props.auth.user.userable_type === 'App\\Models\\Administrador'" class="p-6 text-gray-900">

                        <p>Preencha o formulario abaixo para finalizar um orçamento no sistema.</p>

                        <formDefault @submit.prevent="submit" method="PUT">
                            <template #content>
                                Status: 
                                <input style="margin-right: 4px; margin-left: 5px;" name="orcamento_status" type="checkbox" v-model="form.orcamento_status"/>
                                {{ form.orcamento_status ? "Aprovado" : "Reprovado" }}
                                <InputError class="mt-2" :message="form.errors.orcamento_status" />
                                <br><br>
                                <textAreaNew rotulo="Observação" placeholder="Escreva uma observação para responder o cliente." name="response_observation" type="text"
                                    v-model="form.response_observation" required></textAreaNew>
                                <InputError class="mt-2" :message="form.errors.response_observation" />
                            </template>
                        </formDefault>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>