<script setup>
    import { useForm  } from '@inertiajs/vue3';
    import { ref } from 'vue';


    const { deleteId, destino } = defineProps(['deleteId', 'destino']);

    const formato = ref(true);

    const toggleFormato = () => {
        formato.value = !formato.value;
        console.log(formato.value);
    };

    const form = useForm({
        
    });

    const submit = () => {
        //alert("bla"+bla)
        form.delete(route(destino, {id: deleteId}));
    };

</script>

<template>
    <div
        v-if="formato == true"
        
        @click="toggleFormato"
        class="cursor-pointer inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-red-500 uppercase transition bg-transparent border-2 border-red-500 rounded ripple hover:bg-red-100 focus:outline-none"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
        </svg>
    </div>
    <div class="inline-block px-1 py-0 relative top-[-14px] " v-else>
        <div class="inline-block px-1">
            certeza? 
        </div>
        
        <div @click="submit"  class="cursor-pointer inline-block px-2 py-1 text-xs font-medium leading-6 text-center text-red-500 uppercase transition bg-transparent border-2 border-red-500 rounded ripple hover:bg-red-100 focus:outline-none">
            Sim
        </div> 
        <div class="cursor-pointer inline-block px-2 py-1 text-xs font-medium leading-6 text-center text-gray-500 uppercase transition bg-transparent border-2 border-gray-500 rounded ripple hover:bg-gray-200 focus:outline-none"  @click="toggleFormato">Não</div>
    </div>
</template>
