<?php
class Livre {
    private string $isbn;
    private string $titre;
    private string $auteur;
    private bool $disponible= true ;

    public function __construct(string $isbn, string $titre, string $auteur){
        if (!preg_match('/^(\d{10}|\d{13})$/', $isbn)){
            throw new InvalidArgumentException(
                "ISBN invalide : '$isbn' (10 ou 13 chiffres attendus)"
            );
        }
        $this->isbn = $isbn;
        $this->titre = $titre;
        $this->auteur = $auteur;
    }
    public function getIsbn(): string { return $this->isbn; }
    public function getTitre(): string { return $this->titre; }
    public function getAuteur(): string { return $this->auteur; }
    public function estDisponible(): bool { return $this->disponible; }

        public function emprunter(): void
    {
        if (!$this->disponible) {
            throw new Exception("Le livre '{$this->titre}' est déjà emprunté.");
        }
        $this->disponible = false;
    }

    public function rendre(): void
    {
        if ($this->disponible) {
            throw new Exception("Le livre '{$this->titre}' n'est pas emprunté.");
        }
        $this->disponible = true;
    }
}