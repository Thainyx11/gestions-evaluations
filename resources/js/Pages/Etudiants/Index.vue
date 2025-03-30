<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Étudiants
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Liste des Étudiants</h3>
                        <Link
                            :href="route('etudiants.create')"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        >
                            Ajouter un étudiant
                        </Link>
                    </div>

                    <div v-if="$page.props.flash.success" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ $page.props.flash.success }}
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Numéro
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nom & Prénom
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="etudiant in etudiants" :key="etudiant.id">
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ etudiant.numero_etudiant }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ etudiant.prenom }} {{ etudiant.nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ etudiant.email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        <div class="flex space-x-2">
                                            <link :href="route('etudiants.show', etudiant.id)" class="text-blue-600 hover:text-blue-800">
                                                Voir
                                            </link>
                                            <link :href="route('etudiants.edit', etudiant.id)" class="text-yellow-600 hover:text-yellow-800">
                                                Modifier
                                            </link>
                                            <button @click="supprimer(etudiant.id)" class="text-red-600 hover:text-red-800">
                                                Supprimer
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="etudiants.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucun étudiant enregistré
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
        etudiants: Array,
    },
    methods: {
        supprimer(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
                router.delete(route('etudiants.destroy', id));
            }
        }
    }
}
</script>
