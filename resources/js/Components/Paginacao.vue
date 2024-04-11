<script setup>
    import { Link } from '@inertiajs/vue3';



    defineProps({
        paginacao:{
            required: true,
        }
    });
</script>

<template>

            <div>
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px">
                        <li  v-if="paginacao['current_page'] > 1">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                 :href="paginacao['first_page_url']">
                                 Primeiro
                        </Link>
                        </li>

                        <li v-if="paginacao['current_page'] > 1" >
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                :href="paginacao['prev_page_url']" >&laquo; Anterior</Link>
                        </li>

                        <li v-if="paginacao['current_page'] > 2">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                 :href="paginacao['links'][paginacao['current_page'] - 2]['url']" >{{ paginacao['current_page'] - 2}}</Link>
                        </li>
                        <li v-if="paginacao['current_page'] > 1">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            :href="paginacao['links'][paginacao['current_page'] - 1]['url']" >{{paginacao['current_page'] - 1}}</Link>
                        </li>

                        <li >
                            <Link aria-current="page" class="bg-blue-50 border border-gray-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700  py-2 px-3 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                              >{{ paginacao['current_page']}} </Link>
                        </li>

                        <li v-if="(paginacao['current_page'] + 1) <= paginacao['last_page']">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            :href="paginacao['links'][paginacao['current_page'] + 1]['url']" >{{paginacao['current_page'] + 1}}</Link>
                        </li>
                        <li v-if="(paginacao['current_page'] + 2) <= paginacao['last_page']">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            :href="paginacao['links'][paginacao['current_page'] + 2]['url']" >{{paginacao['current_page'] + 2}}</Link>
                        </li>

                        <li v-if="(paginacao['current_page'] + 1) <= paginacao['last_page']">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                             :href="paginacao['next_page_url']">Próximo &raquo;</Link>
                        </li>

                        <li v-if="(paginacao['current_page'] + 1) <= paginacao['last_page']">
                            <Link class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                             :href="paginacao['last_page_url']" >Ultimo</Link>
                        </li>
                    </ul>
                </nav>
                <p>Maximo por Pagina: {{paginacao['per_page']}} | Total: {{paginacao['total']}}</p>
            </div>




</template>
