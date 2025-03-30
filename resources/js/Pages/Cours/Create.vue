<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter un Cours
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="intitule" class="block text-gray-700 text-sm font-bold mb-2">Intitulé:</label>
                            <input
                                id="intitule"
                                type="text"
                                v-model="form.intitule"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.intitule" class="text-red-500 text-xs mt-1">{{ form.errors.intitule }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                rows="4"
                            ></textarea>
                            <div v-if="form.errors.description" class="text-red-500 text-xs mt-1">{{ form.errors.description }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="coefficient" class="block text-gray-700 text-sm font-bold mb-2">Coefficient:</label>
                            <input
                                id="coefficient"
                                type="number"
                                min="1"
                                v-model="form.coefficient"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.coefficient" class="text-red-500 text-xs mt-1">{{ form.errors.coefficient }}</div>
                        </div>

                        <div class="mb-6">
                            <label for="seuil_reussite" class="block text-gray-700 text-sm font-bold mb-2">Seuil de réussite:</label>
                            <input
                                id="seuil_reussite"
                                type="number"
                                min="0"
                                max="20"
                                v-model="form.seuil_reussite"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div class="text-gray-500 text-xs mt-1">Note minimale sur 20 pour réussir ce cours</div>
                            <div v-if="form.errors.seuil_reussite" class="text-red-500 text-xs mt-1">{{ form.errors.seuil_reussite }}</div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                :disabled="form.processing"
                            >
                                Enregistrer
                            </button>
                            <link
                                :href="route('cours.index')"
                                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                            >
                                Annuler
                            </link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Link,
    },
    setup() {
        const form = useForm({
            intitule: '',
            description: '',
            coefficient: 1,
            seuil_reussite: 10
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route('cours.store'));
        }
    }
}
</script>
