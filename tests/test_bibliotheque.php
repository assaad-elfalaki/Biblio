<?php

$biblio = new Bibliotheque();
verifier($biblio->compter() === 0, 'Une nouvelle bibliotheque est vide!');

$biblio->ajouter(new Livre('9782100545261','Livre_1','Auteur_1'));
verifier($biblio->compter() === 1, 'Après ajout, compter() vaut 1');

try {
    $biblio->ajouter(new Livre('9782100545261','Autre titre','Autre auteur'));
    verifier(false,'Un ISBN en double doit lever une exception!');
} catch (Exception $e) {
    verifier(true,'Un ISBN en double lève une exception');
}