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
}