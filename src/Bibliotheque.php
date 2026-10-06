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
}