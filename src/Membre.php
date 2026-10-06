<?php 
class Membre {
    private int $id;
    private string $nom;
    private array $emprunts = [];

    public function __construct(int $id, string $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function emprunter(Livre $l): void {
        if (count($this->emprunts) >= 3) {
            throw new Exception("Le membre ne peut pas emprunter plus de 3 livres.");
        }

        $l->emprunter();
        $this->emprunts[] = $l;
    }

    public function rendre(Livre $l): void {
        $index = array_search($l, $this->emprunts, true);

        if ($index === false) {
            throw new Exception("Ce livre n'est pas emprunté par ce membre.");
        }

        $l->rendre();
        unset($this->emprunts[$index]);
        $this->emprunts = array_values($this->emprunts);
    }

    public function getEmprunts(): array {
        return $this->emprunts;
    }
}
?>