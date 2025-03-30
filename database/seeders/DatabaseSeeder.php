<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Cours;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Création d'un utilisateur admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Création d'étudiants
        $etudiants = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Marie',
                'email' => 'marie.dupont@example.com',
                'numero_etudiant' => 'E00001',
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Thomas',
                'email' => 'thomas.martin@example.com',
                'numero_etudiant' => 'E00002',
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Sophie',
                'email' => 'sophie.dubois@example.com',
                'numero_etudiant' => 'E00003',
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Lucas',
                'email' => 'lucas.bernard@example.com',
                'numero_etudiant' => 'E00004',
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Emma',
                'email' => 'emma.petit@example.com',
                'numero_etudiant' => 'E00005',
            ],
        ];

        foreach ($etudiants as $etudiant) {
            Etudiant::create($etudiant);
        }

        // Création de cours
        $cours = [
            [
                'intitule' => 'Mathématiques',
                'description' => 'Cours de mathématiques avancées',
                'coefficient' => 3,
                'seuil_reussite' => 10,
            ],
            [
                'intitule' => 'Informatique',
                'description' => 'Programmation et algorithmes',
                'coefficient' => 4,
                'seuil_reussite' => 12,
            ],
            [
                'intitule' => 'Physique',
                'description' => 'Mécanique et électromagnétisme',
                'coefficient' => 3,
                'seuil_reussite' => 10,
            ],
            [
                'intitule' => 'Anglais',
                'description' => 'Communication professionnelle en anglais',
                'coefficient' => 2,
                'seuil_reussite' => 8,
            ],
            [
                'intitule' => 'Gestion de projet',
                'description' => 'Méthodologies de gestion de projet',
                'coefficient' => 2,
                'seuil_reussite' => 10,
            ],
        ];

        foreach ($cours as $c) {
            Cours::create($c);
        }

        // Création d'évaluations
        $evaluations = [
            [
                'etudiant_id' => 1,
                'cours_id' => 1,
                'note' => 15.5,
                'commentaire' => 'Excellent travail',
            ],
            [
                'etudiant_id' => 1,
                'cours_id' => 2,
                'note' => 17,
                'commentaire' => 'Très bonne compréhension des concepts',
            ],
            [
                'etudiant_id' => 1,
                'cours_id' => 3,
                'note' => 14,
                'commentaire' => 'Bon travail',
            ],
            [
                'etudiant_id' => 2,
                'cours_id' => 1,
                'note' => 9,
                'commentaire' => 'Des difficultés en calcul',
            ],
            [
                'etudiant_id' => 2,
                'cours_id' => 2,
                'note' => 13,
                'commentaire' => 'Progrès significatifs',
            ],
            [
                'etudiant_id' => 3,
                'cours_id' => 4,
                'note' => 18,
                'commentaire' => 'Excellent niveau d\'anglais',
            ],
            [
                'etudiant_id' => 3,
                'cours_id' => 5,
                'note' => 16,
                'commentaire' => 'Très bonne organisation',
            ],
            [
                'etudiant_id' => 4,
                'cours_id' => 3,
                'note' => 7,
                'commentaire' => 'Doit revoir les bases',
            ],
            [
                'etudiant_id' => 4,
                'cours_id' => 4,
                'note' => 10,
                'commentaire' => 'Niveau moyen mais suffisant',
            ],
            [
                'etudiant_id' => 5,
                'cours_id' => 1,
                'note' => 12.5,
                'commentaire' => 'Bon niveau général',
            ],
            [
                'etudiant_id' => 5,
                'cours_id' => 5,
                'note' => 15,
                'commentaire' => 'Très bonnes capacités de management',
            ],
        ];

        foreach ($evaluations as $evaluation) {
            Evaluation::create($evaluation);
        }
    }
}
