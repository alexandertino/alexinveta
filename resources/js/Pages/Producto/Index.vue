<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

const { productos } = usePage().props;

const descargarPdf = () => {
        window.open(route('producto.exportarPdf'), '_blank')
}

const eliminarProducto = (id) => {
    if (confirm("¿Estás seguro de eliminar este producto?")) {
        router.delete(route('producto.destroy', id), {
            onSuccess: () => {
                console.log('Producto eliminado.');
            }
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Lista de Productos</h2>
                        <Link
                            :href="route('producto.create')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Nuevo
                        </Link>
                    </div>
                    <div>
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
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Nombre</th>
                                    <th class="py-3 px-4 text-left">Código</th>
                                    <th class="py-3 px-4 text-left">Precio</th>
                                    <th class="py-3 px-4 text-left">Stock</th>
                                    <th class="py-3 px-4 text-left">Descripción</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr v-for="producto in productos" :key="producto.id" class="border-b hover:bg-gray-100">
                                    <td class="py-3 px-4">{{ producto.id }}</td>
                                    <td class="py-3 px-4">{{ producto.nombre }}</td>
                                    <td class="py-3 px-4">{{ producto.codigo }}</td>
                                    <td class="py-3 px-4">{{ producto.precio }}</td>
                                    <td class="py-3 px-4">{{ producto.stock }}</td>
                                    <td class="py-3 px-4">{{ producto.descripcion }}</td>
                                    <td class="py-3 px-4 flex space-x-2">
                                        <Link
                                            :href="route('producto.edit', producto.id)"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                            Editar
                                        </Link>
                                        <button
                                            @click="eliminarProducto(producto.id)"
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
        </div>
    </AuthenticatedLayout>
</template>
