<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

const descargarPdf = () => {

    window.open(route('cliente.exportarPdf'), '_blank')
}

const eliminarCliente = (id) => {
    if (confirm("¿Estás seguro de eliminar este cliente?")) {
        router.delete(route('cliente.destroy', id), {
            onSuccess: () => {
                console.log('Cliente eliminado.');
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
                    <h2 class="text-2xl font-semibold">Listado de Clientes</h2>
                    <Link
                        :href="route('cliente.create')"
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
                                <th class="py-3 px-4 text-left">Nombres</th>
                                <th class="py-3 px-4 text-left">Apellido Paterno</th>
                                <th class="py-3 px-4 text-left">Apellido Materno</th>
                                <th class="py-3 px-4 text-left">Tipo Doc</th>
                                <th class="py-3 px-4 text-left">N° Documento</th>
                                <th class="py-3 px-4 text-left">Teléfono</th>
                                <th class="py-3 px-4 text-left">Dirección</th>
                                <th class="py-3 px-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <tr v-for="cliente in page.props.clientes" :key="cliente.id" class="border-b hover:bg-gray-100">
                                <td class="py-3 px-4">{{ cliente.nombres }}</td>
                                <td class="py-3 px-4">{{ cliente.pri_ape }}</td>
                                <td class="py-3 px-4">{{ cliente.seg_ape }}</td>
                                <td class="py-3 px-4">{{ cliente.docu_tip }}</td>
                                <td class="py-3 px-4">{{ cliente.docu_num }}</td>
                                <td class="py-3 px-4">{{ cliente.telefono }}</td>
                                <td class="py-3 px-4">{{ cliente.direccion }}</td>
                                <td class="py-3 px-4 flex space-x-2">
                                    <Link
                                        :href="route('cliente.edit', cliente.id)"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                        Editar
                                    </Link>
                                    <button
                                        @click="eliminarCliente(cliente.id)"
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
