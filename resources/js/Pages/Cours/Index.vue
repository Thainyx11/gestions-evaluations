<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Cours
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Liste des Cours</h3>
                        <link
                            :href="route('cours.create')"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        >
                            Ajouter un cours
                        </link>
                    </div>

                    <div v-if="$page.props.flash.success" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ $page.props.flash.success }}
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Intitulé
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Coefficient
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Seuil de réussite
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cours in cours" :key="cours.id">
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ cours.intitule }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ cours.coefficient }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ cours.seuil_reussite }}/20
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        <div class="flex space-x-2">
                                            <link :href="route('cours.show', cours.id)" class="text-blue-600 hover:text-blue-800">
                                                Voir
                                            </link>
                                            <link :href="route('cours.edit', cours.id)" class="text-yellow-600 hover:text-yellow-800">
                                                Modifier
                                            </link>
                                            <button @click="supprimer(cours.id)" class="text-red-600 hover:text-red-800">
                                                Supprimer
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="cours.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucun cours enregistré
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Link,
    },
    props: {
        cours: Array,
    },
    methods: {
        supprimer(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
                router.delete(route('cours.destroy', id));
            }
        }
    }
}
</script>
