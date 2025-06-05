<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    nombre: '',
    codigo: '',
    precio: '',
    stock: '',
    descripcion: ''
});

const crearProducto = () => {
    form.post(route('producto.store'), {
        onSuccess: () => {
            console.log('Producto creado exitosamente');
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 max-w-3xl mx-auto">
            <form @submit.prevent="crearProducto" class="bg-white shadow-md rounded px-8 pt-6 pb-8 space-y-4">
                <h2 class="text-xl font-bold mb-4">Crear Producto</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input v-model="form.nombre" type="text" class="border rounded w-full p-2" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Código</label>
                    <input v-model="form.codigo" type="text" class="border rounded w-full p-2" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio</label>
                    <input v-model="form.precio" type="number" step="0.01" class="border rounded w-full p-2" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input v-model="form.stock" type="number" class="border rounded w-full p-2" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea v-model="form.descripcion" class="border rounded w-full p-2" rows="3" />
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </AuthenticatedLayout>
</template>
