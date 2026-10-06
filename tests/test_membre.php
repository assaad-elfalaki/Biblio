<?php
// Encapsulé dans une fonction
(function () {
    $membre = new Membre(1, 'Alice');

    verifier($membre->getId() === 1, 'getId renvoie l\'id');
    verifier($membre->getNom() === 'Alice', 'getNom renvoie le nom');
    verifier(count($membre->getEmprunts()) === 0, 'Un nouveau membre n\'a pas d\'emprunt');

    $livre1 = new Livre('9782100545261', 'Algo 1', 'Cormen');
    $livre2 = new Livre('9782100545262', 'Algo 2', 'Cormen');
    $livre3 = new Livre('9782100545263', 'Algo 3', 'Cormen');
    $livre4 = new Livre('9782100545264', 'Algo 4', 'Cormen');

    $membre->emprunter($livre1);
    verifier(count($membre->getEmprunts()) === 1, 'emprunter ajoute un livre');
    verifier(!$livre1->estDisponible(), 'Le livre emprunté est indisponible');

    $membre->emprunter($livre2);
    $membre->emprunter($livre3);

    $leve = false;
    try { $membre->emprunter($livre4); } catch (Exception $e) { $leve = true; }
    verifier($leve, 'Emprunter plus de 3 livres lève une exception');

    $membre->rendre($livre1);
    verifier(count($membre->getEmprunts()) === 2, 'rendre enlève un livre');
    verifier($livre1->estDisponible(), 'Le livre rendu est disponible');

    $leve = false;
    try { $membre->rendre($livre1); } catch (Exception $e) { $leve = true; }
    verifier($leve, 'Rendre un livre non emprunté par ce membre lève une exception');
})();
