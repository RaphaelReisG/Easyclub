<script setup>

    const model = defineModel({
        type: String,
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
        type: {
            type: String,
            required: true,
        },
    });
</script>

<template>
    <label
        :for="name"
        class="mb-3 block text-base font-medium text-[#07074D]"
    >
       {{ rotulo }}
    </label>
    <input
        
        :type="type"
        :name="name"
        :id="name"
        v-model="model"
        :placeholder="placeholder"
        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
    />
</template>