<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Statistiques -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4">Tableau de bord</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-blue-700">{{ totalEtudiants }}</p>
                            <p class="text-gray-600">Étudiants</p>
                        </div>

                        <div class="bg-green-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-green-700">{{ totalCours }}</p>
                            <p class="text-gray-600">Cours</p>
                        </div>

                        <div class="bg-purple-100 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-purple-700">{{ totalEvaluations }}</p>
                            <p class="text-gray-600">Évaluations</p>
                        </div>
                    </div>
                </div>

                <!-- Dernières évaluations -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Dernières évaluations</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Étudiant
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Cours
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Note
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="evaluation in dernieresEvaluations" :key="evaluation.id">
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ evaluation.etudiant.prenom }} {{ evaluation.etudiant.nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ evaluation.cours.intitule }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        <span
                                            :class="[
                                                'px-2 py-1 rounded-full text-xs font-bold',
                                                evaluation.note >= evaluation.cours.seuil_reussite
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-red-100 text-red-800'
                                            ]"
                                        >
                                            {{ evaluation.note }}/20
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-sm">
                                        {{ new Date(evaluation.created_at).toLocaleDateString() }}
                                    </td>
                                </tr>
                                <tr v-if="dernieresEvaluations.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucune évaluation disponible
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <Link
                            :href="route('evaluations.index')"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        >
                            Voir toutes les évaluations
                        </Link>

                        <Link
                            :href="route('rapport')"
                            class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition"
                        >
                            Générer le rapport
                        </Link>
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
        totalEtudiants: Number,
        totalCours: Number,
        totalEvaluations: Number,
        dernieresEvaluations: Array,
    },
}
</script>
