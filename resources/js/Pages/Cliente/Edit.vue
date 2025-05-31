<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';

const { cliente } = usePage().props;

const form = useForm({
    nombres: cliente.nombres,
    pri_ape: cliente.pri_ape,
    seg_ape: cliente.seg_ape,
    docu_tip: cliente.docu_tip,
    docu_num: cliente.docu_num,
    telefono: cliente.telefono,
    direccion: cliente.direccion,
});

const updateCliente = () => {
    form.put(route('cliente.update', cliente.id), {
        onSuccess: () => {
            console.log('Cliente actualizado correctamente.');
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="updateCliente" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-4">

                    <h2 class="text-xl font-bold mb-4">Editar Cliente</h2>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombres</label>
                        <input type="text" v-model="form.nombres" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Apellido Paterno</label>
                        <input type="text" v-model="form.pri_ape" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Apellido Materno</label>
                        <input type="text" v-model="form.seg_ape" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tipo de Documento</label>
                        <select v-model="form.docu_tip" class="w-full border rounded px-3 py-2" required>
                            <option disabled value="">Seleccione un tipo</option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="CE">Carné de Extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Número de Documento</label>
                        <input type="text" v-model="form.docu_num" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                        <input type="text" v-model="form.telefono" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                        <input type="text" v-model="form.direccion" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                        <Link :href="route('cliente.index')" class="text-blue-600 hover:underline self-center">
                            Cancelar
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
