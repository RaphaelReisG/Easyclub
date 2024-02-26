<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

import DropdownBootstrap from '@/Components/DropdownBootstrap.vue';
import DropdownLinkBootstrap from '@/Components/DropdownLinkBootstrap.vue';
import NavLinkBootstrap from '@/Components/NavLinkBootstrap.vue';

import 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js';
import 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <div>
        <div class="min-h-screen bg-gray-100">

            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <a class="navbar-brand" href="#">Navbar</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <NavLinkBootstrap :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                            </NavLinkBootstrap>

                            <DropdownBootstrap>
                                <template #trigger>
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        configurações
                                    </a>
                                </template>

                                <template #content>
                                    <DropdownLinkBootstrap :href="route('administrador.index')"> Administrador </DropdownLinkBootstrap>
                                    <DropdownLinkBootstrap :href="route('profile.edit')"> Cliente </DropdownLinkBootstrap>
                                </template>
                            </DropdownBootstrap>


                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

