<?php

namespace Database\Seeders;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\RoleVolunteer;
use App\Enums\SexeAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Message;
use App\Models\Note;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vaccin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User seeding */
        User::factory()->create([
            'first_name' => 'Elise',
            'last_name' => 'Dieu',
            'email' => 'admin@example.com',
            'telephone' => '+32 036 27 20 17',
            'role' => RoleVolunteer::Admin,
        ]);
        User::factory()->create([
            'first_name' => 'Thomas',
            'last_name' => 'Gueux',
            'email' => 'test@example.com',
            'telephone' => '+32 036 27 20 17',
            'role' => RoleVolunteer::Volunteer,
        ]);

        $speciesData = [
            'Chien' => ['Labrador', 'Berger allemand', 'Husky', 'Beagle', 'Golden Retriever', 'Bouledogue français'],
            'Chat' => ['Européen', 'Gouttière', 'Siamois', 'Persan', 'Maine Coon'],
            'Raton laveur' => ['Commun', 'Cozumel', 'Crabier'],
        ];

        foreach ($speciesData as $specieName => $breedNames) {
            $specie = Specie::firstOrCreate(['name' => $specieName]);
            foreach ($breedNames as $breedName) {
                Breed::firstOrCreate([
                    'name' => $breedName,
                    'specie_id' => $specie->id,
                ]);
            }
        }

        $vaccinsData = [
            'Chien' => ['Rage', 'CHPPi', 'Leptospirose', 'Piroplasmose'],
            'Chat' => ['Rage', 'Typhus', 'Coryza', 'Leucose'],
            'Raton laveur' => ['Rage', 'Maladie de Carré', 'Parvovirus'],
        ];

        foreach ($vaccinsData as $specieName => $vaccinNames) {
            $specie = Specie::where('name', $specieName)->first();
            foreach ($vaccinNames as $vaccinName) {
                $vaccin = Vaccin::firstOrCreate(['name' => $vaccinName]);
                $specie->vaccins()->syncWithoutDetaching($vaccin->id);
            }
        }

        $coatsData = ['Noir', 'Blanc', 'Roux', 'Gris', 'Brun', 'Crème', 'Tigré', 'Bicolore', 'Tricolore'];
        foreach ($coatsData as $coatName) {
            Coat::firstOrCreate(['name' => $coatName]);
        }

        $behaviorsData = ['Joueur', 'Calme', 'Affectueux', 'Indépendant', 'Protecteur', 'Sociable', 'Timide', 'Energique', 'Curieux'];
        foreach ($behaviorsData as $behaviorName) {
            Behavior::firstOrCreate(['name' => $behaviorName]);
        }

        $maleNames = ['Rex', 'Max', 'Minou', 'Rocky', 'Caramel', 'Oscar', 'Félix', 'Simba', 'Tigrou', 'Pompon', 'Charlie', 'Lucky', 'Noisette', 'Cookie', 'Filou'];
        $femaleNames = ['Luna', 'Bella', 'Nala', 'Duchesse', 'Maya', 'Cléo', 'Lily', 'Minette', 'Cannelle', 'Perle', 'Caline', 'Chipie', 'Zoe', 'Mimi', 'Ruby'];

        $descriptions = [
            'Un compagnon adorable qui adore les câlins et les longues siestes au soleil.',
            'Très joueur et énergique, parfait pour une famille active.',
            'Calme et affectueux, idéal pour un appartement.',
            'Un caractère bien trempé mais un coeur en or.',
            'Sociable et curieux, il s\'adapte facilement à son environnement.',
            'Un peu timide au début, mais très attachant une fois en confiance.',
            'Adore jouer et explorer, ne manque jamais d\'énergie.',
            'Très doux avec les enfants, un vrai compagnon de famille.',
            'Indépendant mais affectueux quand il le décide.',
            'Protecteur et loyal, il veillera sur toute la famille.',
        ];

        $imagesBySpecie = [
            'Chien' => [
                'public/img/animal/Benoit.jpg',
                'public/img/animal/Carlos.jpg',
                'public/img/animal/jean.jpeg',
                'public/img/animal/Pablo.jpg',
            ],
            'Chat' => [
                'public/img/animal/Bastien.jpg',
                'public/img/animal/Larry.jpg',
                'public/img/animal/Samantha.jpg',
            ],
            'Raton laveur' => [
                'public/img/animal/Kenny.jpg',
            ],
        ];

        $statuses = AnimalStatus::cases();

        $startDate = Carbon::create(2025, 2, 1);
        $endDate = Carbon::now();
        $daysDiff = $startDate->diffInDays($endDate);

        $noteTitles = [
            'Visite vétérinaire',
            'Comportement observé',
            'Alimentation',
            'Progrès éducation',
            'Remarque importante',
            'Suivi médical',
        ];

        $noteDescriptions = [
            'Visite de contrôle effectuée, tout va bien. Prochain rendez-vous dans 6 mois.',
            'L\'animal s\'est montré très sociable avec les autres pensionnaires aujourd\'hui.',
            'Changement de croquettes effectué, bonne adaptation.',
            'Bons progrès sur les commandes de base. Continue à bien évoluer.',
            'Légère anxiété observée lors des orages, à surveiller.',
            'Traitement antiparasitaire administré ce jour.',
            'Poids stable, bonne forme générale.',
            'A joué avec les autres animaux sans problème.',
            'Préfère les moments calmes, éviter les environnements bruyants.',
            'Très à l\'aise avec les enfants qui sont venus visiter.',
        ];

        $adoptantLastNames = ['Dupont', 'Martin', 'Bernard', 'Dubois', 'Thomas', 'Robert', 'Richard', 'Petit'];
        $adoptantFirstNames = ['Marie', 'Pierre', 'Sophie', 'Jean', 'Claire', 'Paul', 'Julie', 'Marc'];
        $environments = ['Appartement en ville', 'Maison avec jardin', 'Ferme à la campagne', 'Maison en banlieue'];
        $housingTypes = ['Propriétaire', 'Locataire avec autorisation', 'Propriétaire avec terrain'];
        $motivations = [
            'Je cherche un compagnon fidèle pour égayer mon quotidien.',
            'Notre famille souhaite adopter un animal pour apprendre la responsabilité aux enfants.',
            'Je vis seul et j\'aimerais avoir de la compagnie.',
            'Nous avons un grand jardin et beaucoup d\'amour à donner.',
            'Après le décès de notre précédent compagnon, nous sommes prêts à accueillir un nouveau membre.',
        ];

        $adoptionStatuses = array_filter(
            AdoptionStatus::cases(),
            fn($status) => $status !== AdoptionStatus::InProgress
        );
        $adoptionStatuses = array_values($adoptionStatuses);

        $allBreeds = Breed::all();
        $allCoats = Coat::all();
        $allBehaviors = Behavior::all();
        $adminUser = User::first();

        $createdAnimals = [];

        for ($i = 0; $i < 20; $i++) {
            $sexe = $i % 2 === 0 ? SexeAnimal::Male : SexeAnimal::Female;
            $name = $sexe === SexeAnimal::Male
                ? $maleNames[$i % count($maleNames)]
                : $femaleNames[$i % count($femaleNames)];

            $breed = $allBreeds[$i % count($allBreeds)];
            $specieName = $breed->specie->name;
            $specieImages = $imagesBySpecie[$specieName];
            $avatar = $specieImages[$i % count($specieImages)];

            $randomDays = ($i * 19) % $daysDiff;
            $createdAt = $startDate->copy()->addDays($randomDays);

            $animal = Animal::create([
                'name' => $name,
                'description' => $descriptions[$i % count($descriptions)],
                'age' => ($i % 15) + 1,
                'sexe' => $sexe,
                'author' => 'Admin',
                'state' => $statuses[$i % count($statuses)],
                'avatar' => $avatar,
                'accept_kids' => rand(0, 1) === 1,
                'accept_dogs' => rand(0, 1) === 1,
                'accept_cats' => rand(0, 1) === 1,
                'breed_id' => $breed->id,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $createdAnimals[] = $animal;

            $coatCount = ($i % 2) + 1;
            $coatIds = $allCoats->slice($i % count($allCoats), $coatCount)->pluck('id')->toArray();
            if (empty($coatIds)) {
                $coatIds = [$allCoats->first()->id];
            }
            $animal->coats()->attach($coatIds);

            $behaviorCount = ($i % 2) + 1;
            $behaviorIds = $allBehaviors->slice($i % count($allBehaviors), $behaviorCount)->pluck('id')->toArray();
            if (empty($behaviorIds)) {
                $behaviorIds = [$allBehaviors->first()->id];
            }
            $animal->behaviors()->attach($behaviorIds);

            $specieVaccins = $breed->specie->vaccins;
            if ($specieVaccins->count() > 0) {
                $animal->vaccins()->attach($specieVaccins->pluck('id')->toArray());
            }

            $noteCount = ($i % 3) + 1;
            for ($j = 0; $j < $noteCount; $j++) {
                $noteDate = $createdAt->copy()->addDays(($j + 1) * 7);
                Note::create([
                    'title' => $noteTitles[($i + $j) % count($noteTitles)],
                    'description' => $noteDescriptions[($i + $j) % count($noteDescriptions)],
                    'notable_type' => Animal::class,
                    'notable_id' => $animal->id,
                    'user_id' => $adminUser?->id,
                    'created_at' => $noteDate,
                    'updated_at' => $noteDate,
                ]);
            }
        }

        $adoptableAnimals = array_filter($createdAnimals, fn($animal) => $animal->state !== AnimalStatus::PENDING);
        $adoptableAnimals = array_values($adoptableAnimals);

        for ($i = 0; $i < min(8, count($adoptableAnimals)); $i++) {
            $animal = $adoptableAnimals[$i];
            $adoptionDate = $animal->created_at->copy()->addDays(($i + 1) * 10);

            Adoption::create([
                'last_name' => $adoptantLastNames[$i % count($adoptantLastNames)],
                'first_name' => $adoptantFirstNames[$i % count($adoptantFirstNames)],
                'email' => strtolower($adoptantFirstNames[$i]) . '.' . strtolower($adoptantLastNames[$i]) . '@email.com',
                'telephone' => '+32 470 ' . str_pad(($i + 1) * 11, 2, '0', STR_PAD_LEFT) . ' ' . str_pad(($i + 2) * 12, 2, '0', STR_PAD_LEFT),
                'environment' => $environments[$i % count($environments)],
                'housing_type' => $housingTypes[$i % count($housingTypes)],
                'motivations' => $motivations[$i % count($motivations)],
                'status' => $adoptionStatuses[$i % count($adoptionStatuses)],
                'animal_id' => $animal->id,
                'created_at' => $adoptionDate,
                'updated_at' => $adoptionDate,
            ]);
        }

        $messageTopics = [
            'Demande d\'information',
            'Question sur l\'adoption',
            'Signalement d\'un animal errant',
            'Proposition de bénévolat',
            'Partenariat',
            'Autre',
        ];

        $messageDescriptions = [
            'Bonjour, je souhaiterais avoir plus d\'informations sur les conditions d\'adoption. Merci d\'avance.',
            'J\'ai vu un chat errant dans mon quartier, il semble blessé. Pouvez-vous intervenir ?',
            'Je suis disponible les week-ends pour aider au refuge. Comment puis-je m\'inscrire comme bénévole ?',
            'Notre entreprise souhaite organiser une collecte de nourriture pour les animaux. Est-ce possible ?',
            'Je voudrais savoir si vous acceptez les dons de couvertures et jouets pour animaux.',
            'Quels sont les horaires d\'ouverture du refuge pour les visites ?',
            'J\'ai adopté un chien chez vous il y a 2 ans et je voulais vous donner de ses nouvelles. Il va très bien !',
            'Proposez-vous des formations pour les nouveaux adoptants ?',
        ];

        $messageNames = [
            ['last_name' => 'Leroy', 'first_name' => 'Alice'],
            ['last_name' => 'Moreau', 'first_name' => 'Lucas'],
            ['last_name' => 'Simon', 'first_name' => 'Emma'],
            ['last_name' => 'Laurent', 'first_name' => 'Hugo'],
            ['last_name' => 'Michel', 'first_name' => 'Léa'],
            ['last_name' => 'Garcia', 'first_name' => 'Nathan'],
            ['last_name' => 'Roux', 'first_name' => 'Chloé'],
            ['last_name' => 'Fournier', 'first_name' => 'Louis'],
        ];

        for ($i = 0; $i < 8; $i++) {
            $messageDate = $startDate->copy()->addDays(($i * 12) % $daysDiff);

            Message::create([
                'last_name' => $messageNames[$i]['last_name'],
                'first_name' => $messageNames[$i]['first_name'],
                'email' => strtolower($messageNames[$i]['first_name']) . '.' . strtolower($messageNames[$i]['last_name']) . '@email.com',
                'telephone' => '+32 470 ' . str_pad(($i + 3) * 13, 2, '0', STR_PAD_LEFT) . ' ' . str_pad(($i + 4) * 14, 2, '0', STR_PAD_LEFT),
                'topic' => $messageTopics[$i % count($messageTopics)],
                'description' => $messageDescriptions[$i % count($messageDescriptions)],
                'is_favourite' => $i % 4 === 0,
                'created_at' => $messageDate,
                'updated_at' => $messageDate,
            ]);
        }
    }
}
