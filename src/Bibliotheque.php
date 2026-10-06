<?php

class Bibliotheque {
    /** @var Livre[] indexés par ISBN */
    private array $livres = [];
    public function ajouter(Livre $livre): void {
        if (isset($this->livres[$livre->getIsbn()])) {
            throw new Exception("Un livre avec l'ISBN ". $livre->getIsbn() . " existe deja!");
        }
        $this->livres[$livre->getIsbn()] = $livre;
    }
    public function compter(): int {
        return count($this->livres);
    }
    public function trouver(string $isbn): ?Livre {
        return $this->livres[$isbn] ?? null;
    }
    public function tous(): array {
        return array_values($this->livres);
    }
    public function rechercher(string $mot): array {
        $mot = mb_strtolower($mot);
        return array_values(array_filter(
            $this->livres,
            fn(Livre $l) => str_contains(mb_strtolower($l->getTitre()), $mot) || str_contains(mb_strtolower($l->getAuteur()), $mot)
        ));
    }
}