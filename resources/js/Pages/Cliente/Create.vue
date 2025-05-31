<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    nombres: '',
    pri_ape: '',
    seg_ape: '',
    docu_tip: '',
    docu_num: '',
    telefono: '',
    direccion: '',
});

const createCliente = () => {
    form.post(route('cliente.store'), {
        onSuccess: () => {
            console.log('Cliente creado exitosamente.');
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <form @submit.prevent="createCliente" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-4">

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nombres
                        </label>
                        <input 
                            type="text"
                            v-model="form.nombres"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Apellido Paterno
                        </label>
                        <input 
                            type="text"
                            v-model="form.pri_ape"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Apellido Materno
                        </label>
                        <input 
                            type="text"
                            v-model="form.seg_ape"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Tipo de Documento
                        </label>
                        <select 
                            v-model="form.docu_tip"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                        >
                            <option disabled value="">Seleccione un tipo</option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="CE">Carné de Extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Número de Documento
                        </label>
                        <input 
                            type="text"
                            v-model="form.docu_num"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Teléfono
                        </label>
                        <input 
                            type="text"
                            v-model="form.telefono"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Dirección
                        </label>
                        <input 
                            type="text"
                            v-model="form.direccion"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            autocomplete="off"
                        >
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
