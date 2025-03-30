<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modifier une Évaluation
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="etudiant_id" class="block text-gray-700 text-sm font-bold mb-2">Étudiant:</label>
                            <select
                                id="etudiant_id"
                                v-model="form.etudiant_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                                <option value="" disabled>Sélectionnez un étudiant</option>
                                <option v-for="etudiant in etudiants" :key="etudiant.id" :value="etudiant.id">
                                    {{ etudiant.prenom }} {{ etudiant.nom }} ({{ etudiant.numero_etudiant }})
                                </option>
                            </select>
                            <div v-if="form.errors.etudiant_id" class="text-red-500 text-xs mt-1">{{ form.errors.etudiant_id }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="cours_id" class="block text-gray-700 text-sm font-bold mb-2">Cours:</label>
                            <select
                                id="cours_id"
                                v-model="form.cours_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                                <option value="" disabled>Sélectionnez un cours</option>
                                <option v-for="c in cours" :key="c.id" :value="c.id">
                                    {{ c.intitule }} (Coef. {{ c.coefficient }})
                                </option>
                            </select>
                            <div v-if="form.errors.cours_id" class="text-red-500 text-xs mt-1">{{ form.errors.cours_id }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note (sur 20):</label>
                            <input
                                id="note"
                                type="number"
                                step="0.25"
                                min="0"
                                max="20"
                                v-model="form.note"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.note" class="text-red-500 text-xs mt-1">{{ form.errors.note }}</div>
                        </div>

                        <div class="mb-6">
                            <label for="commentaire" class="block text-gray-700 text-sm font-bold mb-2">Commentaire:</label>
                            <textarea
                                id="commentaire"
                                v-model="form.commentaire"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                rows="3"
                            ></textarea>
                            <div v-if="form.errors.commentaire" class="text-red-500 text-xs mt-1">{{ form.errors.commentaire }}</div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                :disabled="form.processing"
                            >
                                Mettre à jour
                            </button>
                            <link
                                :href="route('evaluations.index')"
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
    props: {
        evaluation: Object,
        etudiants: Array,
        cours: Array,
    },
    setup(props) {
        const form = useForm({
            etudiant_id: props.evaluation.etudiant_id,
            cours_id: props.evaluation.cours_id,
            note: props.evaluation.note,
            commentaire: props.evaluation.commentaire || ''
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.put(route('evaluations.update', this.evaluation.id));
        }
    }
}
</script>
