<?php
// Encapsulé dans une fonction pour ne pas mélanger nos variables
// avec celles de test_bibliotheque.php et test_membre.php
(function () {
    $livre = new Livre('9782100545261', 'Algo', 'Cormen');

    verifier($livre->getIsbn() === '9782100545261', 'getIsbn renvoie l\'ISBN');
    verifier($livre->getTitre() === 'Algo', 'getTitre renvoie le titre');
    verifier($livre->getAuteur() === 'Cormen', 'getAuteur renvoie l\'auteur');
    verifier($livre->estDisponible(), 'Un nouveau livre est disponible');

    $livre->emprunter();
    verifier(!$livre->estDisponible(), 'Après emprunt, le livre est indisponible');

    $leve = false;
    try { $livre->emprunter(); } catch (Exception $e) { $leve = true; }
    verifier($leve, 'Emprunter un livre déjà emprunté lève une exception');

    $livre->rendre();
    verifier($livre->estDisponible(), 'Après retour, le livre est disponible');

    $leve = false;
    try { $livre->rendre(); } catch (Exception $e) { $leve = true; }
    verifier($leve, 'Rendre un livre disponible lève une exception');

    $leve = false;
    try { new Livre('123', 'X', 'Y'); } catch (InvalidArgumentException $e) { $leve = true; }
    verifier($leve, 'ISBN de 3 chiffres refusé');

    $leve = false;
    try { new Livre('12345abcde', 'X', 'Y'); } catch (InvalidArgumentException $e) { $leve = true; }
    verifier($leve, 'ISBN contenant des lettres refusé');

    verifier(new Livre('2100545261', 'X', 'Y') instanceof Livre, 'ISBN de 10 chiffres accepté');

    verifier(str_contains((string) $livre, 'Algo'), '__toString contient le titre');
})();