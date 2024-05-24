<?php

require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Arbitre;
use models\humain\Utilisateur;
use models\organisation\Billet;
use models\organisation\Acheter;
use models\humain\Membre_Equipe;
use models\organisation\Evenement;
use models\organisation\Organiser;
use models\organisation\Participer;
use models\organisation\Assister;
use models\organisation\Periode_Evenement;
use models\organisation\Etat;
use models\organisation\Statuer;
use models\organisation\Sponsor;
use models\organisation\Sponsoriser;
use models\organisation\Media;
use models\organisation\Couvrir;
use models\competition\Arbre;
use models\competition\Phase_A_R;
use models\competition\Phase_Poule;
use models\competition\Match_Rugby;
use models\competition\Aller_Retour;
use models\competition\Etape_Arbre;
use models\competition\Etape_Contient;
use models\competition\Poule;
use models\competition\Poule_Contient;
use models\organisation\Acceder;
use models\competition\Equipe;
use models\organisation\Composer;
use models\organisation\Recompense;
use models\organisation\Recevoir_Recompense;
use models\organisation\Attribuer_Recompense;
use models\competition\Jouer;
use models\organisation\Disputer;
use models\organisation\Arbitrer;

// Récupération des variables d'environnement pour la connection à la bd.
$db_host = getenv('DB_HOST') ?: 'gatherly_db';
$db_port = getenv('DB_PORT') ?: '5432';
$db_name = getenv('DB_NAME') ?: 'gatherly_db';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_password = getenv('DB_PASSWORD') ?: 'postgres';

// Fichier de tests des classes models.

try {

    // Instanciation connecteur BDD


    // /!\ ATTENTION /!\ CETTE LIGNE VA SUPPRIMER LA BASE DE DONNEES ET LA RECREER. /!\ ATTENTION /!\
    $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=postgres", $db_user, $db_password);
    $db->exec('DROP DATABASE IF EXISTS gatherly_db;');
    $db->exec('CREATE DATABASE gatherly_db;');
    $db = null;
    $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);
    $sql = file_get_contents('postgres/create_db.sql');
    $db->exec($sql);
    // /!\ ATTENTION /!\ CETTE LIGNE VA SUPPRIMER LA BASE DE DONNEES ET LA RECREER. /!\ ATTENTION /!\

    // Test pour les dev
    $personne = new Personne(null, 'John', 'Doe', '2000-01-01', 'M');
    $personne->save($db);
    $utilisateur = new Utilisateur(null, 1, "mail@mail.com", "0123456789", password_hash("12345678", PASSWORD_DEFAULT), "true");
    $utilisateur->save($db);

    // Données de test personne
    $names = ["Pierre", "Paul", "Jacques", "Marie", "Sophie", "Nicolas", "Julien", "Jérôme", "William", "Luka", "Alexy", "Alexei", "Py", "Hadopy", "Tommy", "Nathalie", "Céline", "Claire", "Éric", "Olivier", "Laurent", "Benoît", "Christophe", "Patrice", "Vincent", "Denis", "Marc", "Alexandre", "Antoine", "Philippe", "François", "Jean", "Luc", "Guy", "Hervé", "Bruno", "Alain", "Thierry", "Sébastien", "Christian", "Gérard", "John", "Jane", "Sam", "Sara", "Michael", "Michelle", "David", "Danielle", "Robert", "Rebecca", "Daniel", "Diana", "James", "Jennifer", "Brian", "Brianna", "Kevin", "Kim", "Richard", "Rachel", "Paul", "Patricia", "Mark", "Megan", "Joseph", "Jessica", "Matthew", "Melissa", "Andrew", "Amanda", "Joshua", "Jacqueline", "Christopher", "Christine", "Nicholas", "Nicole"];
    $surnames = ["Martin", "Bernard", "Dubois", "Thomas", "Robert", "Petit", "Lafeve", "Juillet", "Oupiquant", "Boin-Rollex", "Ranha", "Sadouguy", "Collier", "Durand", "Leroy", "Moreau", "Simon", "Laurent", "Lefevre", "Michel", "Garcia", "David", "Bertrand", "Roux", "Vincent", "Fournier", "Morel", "Girard", "Andre", "Lefevre", "Mercier", "Dupont", "Lambert", "Bonnet", "Francois", "Martinez", "Legrand", "Garnier", "Faure", "Rousseau", "Blanc", "Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor", "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia", "Martinez", "Robinson", "Clark", "Rodriguez", "Lewis", "Lee", "Walker", "Hall", "Allen", "Young", "Hernandez", "King", "Wright", "Lopez", "Hill", "Scott", "Green", "Adams"];
    $sexes = ['M', 'F', 'A'];
    $birthDate = date("Y-m-d", strtotime("-" . rand(20, 70) . " years"));
    // Données de test utilisateur
    $domains = ["example.com", "lorem.net", "ipsum.org"];
    $passwords = ["password123", "azerty456", "admin789", "secret101112", "passphrase131415"];
    // Données de test membre d'équipe
    $roles = ["joueur", "entraineur"];
    $postes = ["ailier", "centre", "demi d'ouverture", "demi de mêlée", "troisième ligne aile", "deuxième ligne", "pilier", "talonneur", "arrière"];

    // $longueurNames = var_dump(count($names));
    // $longueurSurnames = var_dump(count($surnames));
    // echo $longueurNames;
    // echo $longueurSurnames;

    // Création de personnes
    for ($i = 0; $i < 77; $i++) {
        $name = $names[$i];
        $surname = $surnames[$i];
        $sex = $sexes[array_rand($sexes)];
        $birthDate = date("Y-m-d", strtotime("-" . rand(20, 70) . " years"));
        $personne = new Personne(null, $name, $surname, $birthDate, $sex);
        $personne->save($db);
    }

    // Création d'arbitres
    for ($i = 0; $i < 5; $i++) {
        $arbitre = new Arbitre(null, $i + 1);
        $arbitre->save($db);
    }

    // Création d'utilisateurs
    for ($i = 6; $i <= 20; $i++) {
        $email = strtolower($names[$i]) . rand(1, 100) . "@" . $domains[array_rand($domains)];
        $phone = (rand(0, 1) == 0) ? "123456" . str_pad($i, 4, "0", STR_PAD_LEFT) : null;
        $password = password_hash($passwords[array_rand($passwords)], PASSWORD_DEFAULT);

        if ($i == 9 || $i == 10 || $i == 11) {
            $utilisateur = new Utilisateur(null, $i, $email, $phone, $password, "true");
            $utilisateur->save($db);
        } else {
            $utilisateur = new Utilisateur(null, $i, $email, $phone, $password, "false");
            $utilisateur->save($db);
        }
    }
    $utilisateur = new Utilisateur(null, 'admin', 'admin@admin.com', '0123456789', '$2y$10$o.0Iftav5sQFQrPYHUr4BO8KZ50bC8Zi0HWjZ1JyqRB70SUf2ofyW', "true");

    // Création de membres d'équipes joueurs
    for ($i = 21; $i <= 44; $i++) {
        $role = $roles[0]; // Tous les membres sont des joueurs
        $poste = $postes[array_rand($postes)];

        $membre_equipe = new Membre_Equipe(null, $i, $role, $poste);
        $membre_equipe->save($db);
    }

    // Création de membres d'équipes entraineurs

    for ($i = 45; $i <= 46; $i++) {
        $role = $roles[1]; // Tous les membres sont des entraineurs
        $poste = null;

        $membre_equipe = new Membre_Equipe(null, $i, $role, $poste);
        $membre_equipe->save($db);
    }

    // Création de billets

    $billet = new Billet(null, null, "Billet stylé pour le rugby", "Pelouse", "true");
    $billet->save($db);
    $billet = new Billet(null, "25", "Billet stylé pour le rugby", "Virage", "false");
    $billet->save($db);
    $billet = new Billet(null, "50", "Billet stylé pour le rugby", "Tribune", "false");
    $billet->save($db);
    $billet = new Billet(null, "110", "Billet stylé pour le rugby", "VIP", "false");
    $billet->save($db);

    // Création d'achat de billets
    $cpt = 1;
    for ($i = 1; $i <= 4; $i++) {
        $currentDateTime = date("Y-m-d H:i:s"); // Format : DD-MM-YYYY HH:MM:SS // WARNING: CETTE LIGNE NE FONCTIONNE PAS SUR LE VPS MAIS FONCTIONNE EN LOCAL
        $acheter = new Acheter(null, $currentDateTime, $i, $cpt);
        $acheter->save($db);
        $cpt++;
    }

    // Création d'événements
    $evenement1 = new Evenement(null, "Tournoi de rugby", "Un tournoi de rugby passionnant avec les meilleures équipes", "toucher", "15", "Arbre");
    $evenement1->save($db);
    $etat1 = new Etat(null, $db->lastInsertId(), "true", "false");
    $etat1->save($db);
    $statuer1 = new Statuer(null, $db->lastInsertId(), 1, date("Y-m-d"));
    $statuer1->save($db);

    $evenement2 = new Evenement(null, "Match de charité", "Un match de charité pour soutenir une bonne cause", "toucher", "7", "Match");
    $evenement2->save($db);
    $etat2 = new Etat(null, $db->lastInsertId(), "false", "true");
    $etat2->save($db);
    $statuer2 = new Statuer(null, $db->lastInsertId(), 1, date("Y-m-d"));
    $statuer2->save($db);

    $evenement3 = new Evenement(null, "Entraînement ouvert", "Venez voir comment les professionnels s'entraînent", "toucher", "15", "Match");
    $evenement3->save($db);
    $etat3 = new Etat(null, $db->lastInsertId(), "false", "true");
    $etat3->save($db);
    $statuer3 = new Statuer(null, $db->lastInsertId(), 1, date("Y-m-d"));
    $statuer3->save($db);

    $evenement4 = new Evenement(null, "Championnat de contact", "Un match de rugby de contact intense", "contact", "15", "A_R");
    $evenement4->save($db);
    $etat4 = new Etat(null, $db->lastInsertId(), "false", "true");
    $etat4->save($db);
    $statuer4 = new Statuer(null, $db->lastInsertId(), 1, date("Y-m-d"));
    $statuer4->save($db);

    // Création d'organisateurs
    $cpt = 1;
    for ($i = 5; $i <= 8; $i++) {
        // Génération aléatoire de dates
        $randomTimeStamp = rand(strtotime("2020-01-01"), strtotime("2023-12-31")); // Générer un timestamp aléatoire entre deux dates
        $Date = date("Y-m-d", $randomTimeStamp); // Convertir le timestamp en date
        // echo $Date."\n";

        $organiser = new Organiser(null, $i, $cpt, $Date);
        $organiser->save($db);
        $cpt++;
    }

    // Création de spectateurs
    $cpt = 1;
    for ($i = 9; $i <= 12; $i++) {

        // Génération aléatoire de dates
        $randomTimeStamp = rand(strtotime("2020-01-01"), strtotime("2023-12-31"));
        $Date = date("Y-m-d", $randomTimeStamp);

        // Requête date de création de l'événement
        $query = $db->prepare("SELECT date_creation FROM organiser WHERE id_organiser = :id_organiser");
        $query->execute([':id_organiser' => $cpt]);

        // Récupérer la date de création
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $eventCreationDate = $row['date_creation'];
        // echo $eventCreationDate."\n";

        // Boucle pour s'assurer que le randomTimeStamp est bien postérieur à la date de création de l'événement
        while ($Date < $eventCreationDate) {
            $randomTimeStamp = rand(strtotime("2020-01-01"), strtotime("2023-12-31"));
            $Date = date("Y-m-d", $randomTimeStamp);
        }

        $assister = new Participer(null, $i, $cpt, $Date);
        $assister->save($db);
        $cpt++;
    }

    // Que faire de participer ? Donne-t-on le droit à un membre d'équipe de s'inscrire en tant que participant ? Sachant que seuls les utilisateurs peuvent s'inscrire en tant que participant.
    $participer = new Participer(null, 1, 1, "2021-01-14");
    $participer->save($db);

    // Création de périodes d'événements
    for ($i = 1; $i <= 4; $i++) {

        // Requête pour récupérer la date de création de l'événement
        // $query = $db->prepare("SELECT date_creation FROM organiser WHERE id_organiser = :id_organiser");
        // $query->execute([':id_organiser' => $i]);

        // Stocker la date de création
        // $row = $query->fetch(PDO::FETCH_ASSOC);
        // $eventCreationDate = $row['date_creation'];
        // echo $eventCreationDate."\n";

        $evenement6 = new Evenement();
        $evenement6->find(null, $i);

        $organiser = new Organiser();
        $organiser->find_by_column(null, 'id_evenement_organise', $i);

        $randomTimeStamp = rand(strtotime($eventCreationDate), strtotime(date("Y-m-d")));
        $DateDebutEvenement = date("Y-m-d", $randomTimeStamp);

        while ($DateDebutEvenement < $eventCreationDate) {
            $randomTimeStamp = rand(strtotime("2020-01-01"), strtotime(date("Y-m-d")));
            $DateDebutEvenement = date("Y-m-d", $randomTimeStamp);
        }

        $randomTimeStamp = rand(strtotime($DateDebutEvenement), strtotime(date("Y-m-d")));
        $DateFinEvenement = date("Y-m-d", $randomTimeStamp);

        $periode_evenement = new Periode_Evenement(null, $i, $DateDebutEvenement, $DateFinEvenement);
        $periode_evenement->save($db);
    }

    $etat = new Etat(null, 1, "false", "false");
    $etat->save($db);

    $statuer = new Statuer(null, 1, 1, "2021-01-14");
    $statuer->save($db);

    $sponsor = new Sponsor(null, "SponsorX", "sponsor@sponsor.com", "12345678");
    $sponsor->save($db);

    $sponsoriser = new Sponsoriser(null, 1, 1);
    $sponsoriser->save($db);

    $media = new Media(null, "mediaX", "media@mail.com", "123456789");
    $media->save($db);

    $couvrir = new Couvrir(null, 1, 1);
    $couvrir->save($db);

    $arbre = new Arbre(null, 1, "2021-01-14");
    $arbre->save($db);

    $phase_a_r = new Phase_A_R(null, 1, "2021-01-14", 1);
    $phase_a_r->save($db);

    $phase_poule = new Phase_Poule(null, 1, "2021-01-14", 1);
    $phase_poule->save($db);

    $match_rugby = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby->save($db);

    $match_rugby_2 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_2->save($db);

    $match_rugby_3 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_3->save($db);

    $match_rugby_4 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_4->save($db);

    $aller_retour = new Aller_Retour(null, 1, 2, 1);
    $aller_retour->save($db);

    $Etape_Arbre = new Etape_Arbre(null, 1, "huitieme");
    $Etape_Arbre->save($db);

    $etape_contient = new Etape_Contient(null, 1, 3);
    $etape_contient->save($db);

    $poule = new Poule(null, 1, "Groupe A", "2021-01-14");
    $poule->save($db);

    $poule_contient = new Poule_Contient(null, 1, 4);
    $poule_contient->save($db);

    $acceder = new Acceder(null, 1, 1);
    $acceder->save($db);

    $equipe = new Equipe(null, "EquipeX", 1);
    $equipe->save($db);

    $composer = new Composer(null, 1, 1);
    $composer->save($db);

    $recompense = new Recompense(null, "Médaille d'or", "Or");
    $recompense->save($db);

    $recevoir_recompense = new Recevoir_Recompense(null, 1, 1);
    $recevoir_recompense->save($db);

    $attribuer_recompense = new Attribuer_Recompense(null, 1, 1);
    $attribuer_recompense->save($db);

    $jouer = new Jouer(null, 1, 1);
    $jouer->save($db);

    $disputer = new Disputer(null, 1, 1);
    $disputer->save($db);

    $arbitrer = new Arbitrer(null, 1, 1);
    $arbitrer->save($db);

    echo "TEST REUSSI\n";
} catch (Exception $e) {
    echo "TEST FAILED: $e\n";
}
