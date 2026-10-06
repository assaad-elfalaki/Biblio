<?php
require_once 'autoload.php';

$bibliotheque = new Bibliotheque();
// Initialize an array of members
$membres = [
    1 => new Membre(1, "Alice"),
    2 => new Membre(2, "Bob")
];

function afficherMenu(): void {
    echo "\n=== Menu Bibliothèque ===\n";
    echo "1. Ajouter un livre\n";
    echo "2. Lister les livres\n";
    echo "3. Rechercher un livre\n";
    echo "4. Emprunter un livre\n";
    echo "5. Rendre un livre\n";
    echo "0. Quitter\n";
    echo "Choix : ";
}

function lireEntree(): string {
    return trim(fgets(STDIN));
}

while (true) {
    afficherMenu();
    $choix = lireEntree();

    switch ($choix) {
        case '1':
            echo "ISBN : ";
            $isbn = lireEntree();
            echo "Titre : ";
            $titre = lireEntree();
            echo "Auteur : ";
            $auteur = lireEntree();
            try {
                $livre = new Livre($isbn, $titre, $auteur);
                $bibliotheque->ajouter($livre);
                echo "Livre ajouté avec succès.\n";
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage() . "\n";
            }
            break;

        case '2':
            $livres = $bibliotheque->tous();
            if (empty($livres)) {
                echo "La bibliothèque est vide.\n";
            } else {
                foreach ($livres as $livre) {
                    echo "- " . $livre . "\n";
                }
            }
            break;

        case '3':
            echo "Mot clé : ";
            $mot = lireEntree();
            $resultats = $bibliotheque->rechercher($mot);
            if (empty($resultats)) {
                echo "Aucun livre trouvé.\n";
            } else {
                foreach ($resultats as $livre) {
                    echo "- " . $livre . "\n";
                }
            }
            break;

        case '4':
            echo "ISBN du livre à emprunter : ";
            $isbn = lireEntree();
            $livre = $bibliotheque->trouver($isbn);
            if (!$livre) {
                echo "Livre introuvable dans la bibliothèque.\n";
                break;
            }
            echo "ID du membre (ex: 1 pour Alice, 2 pour Bob) : ";
            $id = (int)lireEntree();
            if (!isset($membres[$id])) {
                echo "Membre introuvable.\n";
                break;
            }
            try {
                $membres[$id]->emprunter($livre);
                echo "Livre emprunté avec succès.\n";
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage() . "\n";
            }
            break;

        case '5':
            echo "ISBN du livre à rendre : ";
            $isbn = lireEntree();
            $livre = $bibliotheque->trouver($isbn);
            if (!$livre) {
                echo "Livre introuvable dans la bibliothèque.\n";
                break;
            }
            echo "ID du membre : ";
            $id = (int)lireEntree();
            if (!isset($membres[$id])) {
                echo "Membre introuvable.\n";
                break;
            }
            try {
                $membres[$id]->rendre($livre);
                echo "Livre rendu avec succès.\n";
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage() . "\n";
            }
            break;

        case '0':
            echo "Au revoir !\n";
            exit(0);

        default:
            echo "Choix invalide. Veuillez réessayer.\n";
    }
}
