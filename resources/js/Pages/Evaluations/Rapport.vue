<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rapport des Résultats
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Bilan des évaluations</h3>
                        <div class="flex space-x-2">
                            <button
                                @click="exporterPDF"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
                            >
                                Exporter en PDF
                            </button>
                            <link
                                :href="route('evaluations.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Retour aux évaluations
                            </link>
                        </div>
                    </div>

                    <!-- Statistiques générales -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-green-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-green-700">{{ getNbAdmis() }}</p>
                            <p class="text-gray-600">Étudiants admis</p>
                        </div>

                        <div class="bg-yellow-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-yellow-700">{{ getNbAjournes() }}</p>
                            <p class="text-gray-600">Étudiants ajournés</p>
                        </div>

                        <div class="bg-red-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-red-700">{{ getNbRefuses() }}</p>
                            <p class="text-gray-600">Étudiants refusés</p>
                        </div>
                    </div>

                    <!-- Liste des résultats -->
                    <div id="rapport-resultats">
                        <h4 class="font-medium text-gray-700 mb-4">Résultats par étudiant</h4>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Étudiant
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Numéro
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Moyenne
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="resultat in resultats" :key="resultat.etudiant.id">
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ resultat.etudiant.prenom }} {{ resultat.etudiant.nom }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ resultat.etudiant.numero_etudiant }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ resultat.moyenne }}/20
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <span
                                                :class="[
                                                    'px-2 py-1 rounded-full text-xs font-bold',
                                                    resultat.status === 'Admis'
                                                        ? 'bg-green-100 text-green-800'
                                                        : resultat.status === 'Ajourné'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800'
                                                ]"
                                            >
                                                {{ resultat.status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <link :href="route('etudiants.show', resultat.etudiant.id)" class="text-blue-600 hover:text-blue-800">
                                                Détails
                                            </link>
                                        </td>
                                    </tr>
                                    <tr v-if="resultats.length === 0">
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Aucun résultat disponible
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Link,
    },
    props: {
        resultats: Array,
    },
    methods: {
        getNbAdmis() {
            return this.resultats.filter(r => r.status === 'Admis').length;
        },
        getNbAjournes() {
            return this.resultats.filter(r => r.status === 'Ajourné').length;
        },
        getNbRefuses() {
            return this.resultats.filter(r => r.status === 'Refusé').length;
        },
        exporterPDF() {
            alert('Fonctionnalité d\'export PDF à implémenter');

        }
    }
}
</script>
