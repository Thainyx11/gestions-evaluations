<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modifier un Étudiant
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                            <input
                                id="nom"
                                type="text"
                                v-model="form.nom"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.nom" class="text-red-500 text-xs mt-1">{{ form.errors.nom }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                            <input
                                id="prenom"
                                type="text"
                                v-model="form.prenom"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.prenom" class="text-red-500 text-xs mt-1">{{ form.errors.prenom }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                        </div>

                        <div class="mb-6">
                            <label for="numero_etudiant" class="block text-gray-700 text-sm font-bold mb-2">Numéro d'Étudiant:</label>
                            <input
                                id="numero_etudiant"
                                type="text"
                                v-model="form.numero_etudiant"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            >
                            <div v-if="form.errors.numero_etudiant" class="text-red-500 text-xs mt-1">{{ form.errors.numero_etudiant }}</div>
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
                                :href="route('etudiants.index')"
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
        etudiant: Object,
    },
    setup(props) {
        const form = useForm({
            nom: props.etudiant.nom,
            prenom: props.etudiant.prenom,
            email: props.etudiant.email,
            numero_etudiant: props.etudiant.numero_etudiant
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.put(route('etudiants.update', this.etudiant.id));
        }
    }
}
</script>
