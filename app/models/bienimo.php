<?php
// app/models/bienimo.php

class Bienimo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre statut optionnel
    public function findAll(?string $statut = null): array {
        if ($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM bien_immobilier WHERE statut=? ORDER BY date_ajout DESC'
            );
            $s->execute([$statut]);
        } else {
            $s = $this->pdo->query(
                'SELECT * FROM bien_immobilier ORDER BY date_ajout DESC'
            );
        }
        return $s->fetchAll();
    }

    // Trouver un seul bien
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM bien_immobilier WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }
    public function findparproprietaire(int $owner_id): array|false{
          $s = $this->pdo->prepare(
            'SELECT * FROM bien_immobilier WHERE owner_id = ?'
        );
        $s->execute([$owner_id]);
        return $s->fetch();
    }
    public function findDisponibles(): array|false{
          $s = $this->pdo->prepare(
            'SELECT * FROM bien_immobilier WHERE staut = "disponible"'
        );
        return $s->fetch();
    }
    

    // Créer
    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO bien_immobilier
             (owner_id,titre,type_bien,adresse,ville,statut,prix_location)
             VALUES (:owner_id,:titre,:type_bien,:adresse,:ville,:statut,:prix)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE bien_immobilier SET titre=:titre, statut=:statut,
             prix_location=:prix WHERE id=:id'
        );
        return $s->execute($d);
    }

    // Supprimer
   public function delete(int $id, int $owner_id): bool {

    $s = $this->pdo->prepare(
        'DELETE FROM bien_immobilier
         WHERE id = ?
         AND owner_id = ?
         AND statut = "libre"'
    );

    return $s->execute([$id, $owner_id]);
}
}