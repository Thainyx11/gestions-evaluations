<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détails de l'Étudiant
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ etudiant.prenom }} {{ etudiant.nom }}</h3>
                        <div class="flex space-x-2">
                            <link
                                :href="route('etudiants.edit', etudiant.id)"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition"
                            >
                                Modifier
                            </link>
                            <link
                                :href="route('etudiants.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Retour à la liste
                            </link>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded mb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Numéro d'étudiant</p>
                                <p class="font-semibold">{{ etudiant.numero_etudiant }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-semibold">{{ etudiant.email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Évaluations</h4>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Cours
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Note
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Coefficient
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Résultat
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="evaluation in etudiant.evaluations" :key="evaluation.id">
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ evaluation.cours.intitule }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ evaluation.note }}/20
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ evaluation.cours.coefficient }}
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
                                                {{ evaluation.note >= evaluation.cours.seuil_reussite ? 'Réussi' : 'Échoué' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr v-if="etudiant.evaluations.length === 0">
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Aucune évaluation disponible
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-if="etudiant.evaluations.length > 0" class="bg-blue-50 p-4 rounded">
                        <p class="font-medium">Moyenne générale: <span class="font-bold">{{ calculerMoyenne() }}/20</span></p>
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
        etudiant: Object,
    },
    methods: {
        calculerMoyenne() {
            let totalPoints = 0;
            let totalCoefs = 0;

            this.etudiant.evaluations.forEach(evaluation => {
                const coef = evaluation.cours.coefficient;
                totalPoints += evaluation.note * coef;
                totalCoefs += coef;
            });

            return totalCoefs > 0 ? (totalPoints / totalCoefs).toFixed(2) : '0.00';
        }
    }
}
</script>
