<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détails de l'Évaluation
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            Évaluation de {{ evaluation.etudiant.prenom }} {{ evaluation.etudiant.nom }}
                        </h3>
                        <div class="flex space-x-2">
                            <link
                                :href="route('evaluations.edit', evaluation.id)"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition"
                            >
                                Modifier
                            </link>
                            <link
                                :href="route('evaluations.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Retour à la liste
                            </link>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-100 p-4 rounded">
                            <h4 class="font-medium text-gray-700 mb-2">Informations sur l'étudiant</h4>
                            <p><span class="text-gray-600">Nom:</span> {{ evaluation.etudiant.nom }}</p>
                            <p><span class="text-gray-600">Prénom:</span> {{ evaluation.etudiant.prenom }}</p>
                            <p><span class="text-gray-600">Numéro:</span> {{ evaluation.etudiant.numero_etudiant }}</p>
                            <p><span class="text-gray-600">Email:</span> {{ evaluation.etudiant.email }}</p>
                        </div>

                        <div class="bg-gray-100 p-4 rounded">
                            <h4 class="font-medium text-gray-700 mb-2">Informations sur le cours</h4>
                            <p><span class="text-gray-600">Intitulé:</span> {{ evaluation.cours.intitule }}</p>
                            <p><span class="text-gray-600">Coefficient:</span> {{ evaluation.cours.coefficient }}</p>
                            <p><span class="text-gray-600">Seuil de réussite:</span> {{ evaluation.cours.seuil_reussite }}/20</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Résultat de l'évaluation</h4>
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">{{ evaluation.note }}/20</div>
                            <span
                                :class="[
                                    'px-3 py-1 rounded-full text-sm font-bold',
                                    evaluation.note >= evaluation.cours.seuil_reussite
                                        ? 'bg-green-200 text-green-800'
                                        : 'bg-red-200 text-red-800'
                                ]"
                            >
                                {{ evaluation.note >= evaluation.cours.seuil_reussite ? 'Réussi' : 'Échoué' }}
                            </span>
                        </div>
                    </div>

                    <div v-if="evaluation.commentaire" class="bg-yellow-50 p-4 rounded">
                        <h4 class="font-medium text-gray-700 mb-2">Commentaire</h4>
                        <p class="text-gray-800">{{ evaluation.commentaire }}</p>
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
        evaluation: Object,
    },
}
</script>
