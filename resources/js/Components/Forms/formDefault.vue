<script setup>
    defineProps({
        method: {
            type: String,
            required: true,
        },

    });

</script>

<template>
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="" :method="method">
                <slot name="content" />

                <div>
                    <button
                    class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>