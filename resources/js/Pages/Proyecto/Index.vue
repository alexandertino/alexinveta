<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

const descargarPdf = () => {

    window.open(route('proyecto.exportarPdf'), '_blank')
}

const eliminarproyecto = (id) => {
    if (confirm("¿Estás seguro de eliminar este proyecto?")) {
        router.delete(route('proyecto.destroy', id), {
            onSuccess: () => {
                console.log('proyecto eliminado.');
            }
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Listado de Proyectos</h2>
                    <Link
                        :href="route('proyecto.create')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nuevo
                    </Link>
                    
                </div>

                <div class="p-4 m-2">
                    <button
                        @click="descargarPdf"
                        class="bg-blue-500 text-white py-2 px-4 rounded">
                        descargar PDF
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="border px-4 py-2 text-left">Nombre</th>
                                <th class="border px-4 py-2 text-left">Cliente</th>
                                <th class="border px-4 py-2 text-left">Fecha Inicio</th>
                                <th class="border px-4 py-2 text-left">Fecha Fin</th>
                                <th class="border px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <tr v-for="proyecto in page.props.proyectos" :key="proyecto.id" class="border-b hover:bg-gray-100">
                                <td class="py-3 px-4">{{ proyecto.nombre }}</td>
                                <td class="py-3 px-4">{{ proyecto.cliente.nombres }}</td>
                                <td class="py-3 px-4">{{ proyecto.fecha_inicio }}</td>
                                <td class="py-3 px-4">{{ proyecto.fecha_fin }}</td>
                                <td class="py-3 px-4 flex space-x-2">
                                    <Link
                                        :href="route('proyecto.edit', proyecto.id)"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                        Editar
                                    </Link>
                                    <button
                                        @click="eliminarproyecto(proyecto.id)"
                                        class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
