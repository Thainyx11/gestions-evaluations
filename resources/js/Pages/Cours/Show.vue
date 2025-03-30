<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détails du Cours
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ cours.intitule }}</h3>
                        <div class="flex space-x-2">
                            <link
                                :href="route('cours.edit', cours.id)"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition"
                            >
                                Modifier
                            </link>
                            <link
                                :href="route('cours.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Retour à la liste
                            </link>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded mb-6">
                        <div class="grid grid-cols-1 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Description</p>
                                <p class="font-semibold">{{ cours.description || 'Aucune description' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Coefficient</p>
                                <p class="font-semibold">{{ cours.coefficient }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Seuil de réussite</p>
                                <p class="font-semibold">{{ cours.seuil_reussite }}/20</p>
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
                                            Étudiant
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Note
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Résultat
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="evaluation in cours.evaluations" :key="evaluation.id">
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ evaluation.etudiant.prenom }} {{ evaluation.etudiant.nom }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ evaluation.note }}/20
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <span
                                                :class="[
                                                    'px-2 py-1 rounded-full text-xs font-bold',
                                                    evaluation.note >= cours.seuil_reussite
                                                        ? 'bg-green-100 text-green-800'
                                                        : 'bg-red-100 text-red-800'
                                                ]"
                                            >
                                                {{ evaluation.note >= cours.seuil_reussite ? 'Réussi' : 'Échoué' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-sm">
                                            {{ new Date(evaluation.created_at).toLocaleDateString() }}
                                        </td>
                                    </tr>
                                    <tr v-if="cours.evaluations.length === 0">
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Aucune évaluation disponible
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-if="cours.evaluations.length > 0" class="bg-blue-50 p-4 rounded">
                        <p class="font-medium">Moyenne des notes: <span class="font-bold">{{ calculerMoyenne() }}/20</span></p>
                        <p class="font-medium mt-2">Taux de réussite: <span class="font-bold">{{ calculerTauxReussite() }}%</span></p>
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
        cours: Object,
    },
    methods: {
        calculerMoyenne() {
            if (this.cours.evaluations.length === 0) return '0.00';

            const totalNotes = this.cours.evaluations.reduce((acc, evaluation) => acc + evaluation.note, 0);
            return (totalNotes / this.cours.evaluations.length).toFixed(2);
        },
        calculerTauxReussite() {
            if (this.cours.evaluations.length === 0) return '0';

            const reussites = this.cours.evaluations.filter(
                evaluation => evaluation.note >= this.cours.seuil_reussite
            ).length;

            return Math.round((reussites / this.cours.evaluations.length) * 100);
        }
    }
}
</script>
