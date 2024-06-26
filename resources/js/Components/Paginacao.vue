<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    paginacao: {
        type: Object,
        required: true,
    }
});

const objeto = props.paginacao;
</script>

<template>
    <div>
        <nav v-show="objeto['last_page'] !== 1" aria-label="Page navigation example">
            <br>
            <ul class="inline-flex -space-x-px">
                <li v-if="objeto['current_page'] > 1"> <!-- Primeira Pagina-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['first_page_url']">
                    Primeiro
                    </Link>
                </li>

                <li v-if="objeto['current_page'] > 1"> <!-- Pagina Anterior-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['prev_page_url']">&laquo; </Link>
                </li>

                <li v-if="objeto['current_page'] > 2"> <!-- 2 paginas antes-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['links'][objeto['current_page'] - 2]['url']">{{ objeto['current_page'] - 2 }}
                    </Link>
                </li>
                <li v-if="objeto['current_page'] > 1"> <!-- 1 paginas antes-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['links'][objeto['current_page'] - 1]['url']">{{ objeto['current_page'] - 1 }}
                    </Link>
                </li>

                <li> <!-- pagina atual-->
                    <Link aria-current="page" 
                        class="bg-blue-50 border border-gray-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700  py-2 px-3 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                    {{ objeto['current_page'] }} </Link>
                </li>

                <li v-if="(objeto['current_page'] + 1) <= objeto['last_page']"> <!-- pagina +1-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['links'][objeto['current_page'] + 1]['url']">{{ objeto['current_page'] + 1 }}
                    </Link>
                </li>
                <li v-if="(objeto['current_page'] + 2) <= objeto['last_page']"> <!-- pagina +2-->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['links'][objeto['current_page'] + 2]['url']">{{ objeto['current_page'] + 2 }}
                    </Link>
                </li>

                <li v-if="(objeto['current_page'] + 1) <= objeto['last_page']"> <!-- proxima pagina -->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['next_page_url']"> &raquo;</Link>
                </li>

                <li v-if="(objeto['current_page'] + 1) <= objeto['last_page']"> <!-- ultima pagina -->
                    <Link
                        class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :href="objeto['last_page_url']">Ultimo</Link>
                </li>
            </ul>
        </nav>
        <br>
        <p>Maximo por Pagina: {{ objeto['per_page'] }} | Total: {{ objeto['total'] }}</p>
        <br>
    </div>
</template>
