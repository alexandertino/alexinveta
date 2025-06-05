<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const { producto } = usePage().props;

const form = useForm({
    nombre: producto.nombre,
    codigo: producto.codigo,
    precio: producto.precio,
    stock: producto.stock,
    descripcion: producto.descripcion
});

const actualizarProducto = () => {
    form.put(route('producto.update', producto.id), {
        onSuccess: () => {
            console.log('Producto actualizado exitosamente');
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 max-w-3xl mx-auto">
            <form @submit.prevent="actualizarProducto" class="bg-white shadow-md rounded px-8 pt-6 pb-8 space-y-4">
                <h2 class="text-xl font-bold mb-4">Editar Producto</h2>

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
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
