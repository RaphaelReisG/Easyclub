<script setup>
    import { onMounted } from 'vue'
    import { initFlowbite } from 'flowbite'

    onMounted(() => {
        initFlowbite();
    })

    const model = defineModel({
        required: true,
    });

    defineProps({
        rotulo: {
            type: String,
            required: true,
        },
        placeholder: {
            type: String,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
        lista: {
            type: String,
            required: true,
        },
    });
</script>

<template>



    <div class="max-w-2xl mx-auto">

        <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"> {{ rotulo }}</label>
        
        <select v-model="model" :id="name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            <option value="" disabled selected> {{ placeholder }}</option>
            <option v-for="(obj, index) in  $page.props[lista] " :value="obj.id"> {{ obj.name }} </option>
        </select>



    </div>
</template>