<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const { proyecto, clientes } = usePage().props;

const form = useForm({
  nombre: proyecto.nombre,
  cliente_id: proyecto.cliente_id,
  descripcion: proyecto.descripcion,
  fecha_inicio: proyecto.fecha_inicio,
  fecha_fin: proyecto.fecha_fin,
});

const updateProyecto = () => {
    form.put(route('proyecto.update', proyecto.id), {
        onSuccess: () => {
            console.log('Proyecto actualizado exitosamente.');
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="updateProyecto" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-4">

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

                    <div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
