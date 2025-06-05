<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

// Obtener los clientes enviados desde el controlador
const { clientes } = usePage().props;

const form = useForm({
  nombre: '',
  cliente_id: '',
  descripcion: '',
  fecha_inicio: '',
  fecha_fin: '',
});

const createProyecto = () => {
    form.post(route('proyecto.store'), {
        onSuccess: () => {
            console.log('Proyecto creado exitosamente.');
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="createProyecto" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-4">

                    <!-- Nombre del proyecto -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nombre del Proyecto
                        </label>
                        <input 
                            type="text"
                            v-model="form.nombre"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Cliente
                        </label>
                        <select 
                            v-model="form.cliente_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                        >
                            <option disabled value="">Seleccione un cliente</option>
                            <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                                {{ cliente.nombres }} {{ cliente.apellido }}
                            </option>
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Descripción
                        </label>
                        <input 
                            type="text"
                            v-model="form.descripcion"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <!-- Fecha de inicio -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Fecha de Inicio
                        </label>
                        <input 
                            type="date"
                            v-model="form.fecha_inicio"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                        >
                    </div>

                    <!-- Fecha de fin -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Fecha de Fin
                        </label>
                        <input 
                            type="date"
                            v-model="form.fecha_fin"
                            class="shadow appearance-none border rounded w-full py-2 px-3"
                        >
                    </div>

                    <!-- Botón de guardar -->
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
