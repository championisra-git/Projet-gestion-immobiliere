<?php
// app/models/bienimo.php

class Charges {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre statut optionnel
   public function findAll(?string $id_proprieté = null,?string $type_depense = null): array {
         if ($id_proprieté) {
            $s = $this->pdo->prepare(
                'SELECT * FROM charges WHERE id_proprieté=? ORDER BY id ASC'
            );
            $s->execute([$id_proprieté]);
        } elseif($type_depense) {
            $s = $this->pdo->prepare(
                'SELECT * FROM charges WHERE type_depense=? ORDER BY id ASC'
            );
            $s->execute([$type_depense]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM charges ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }
    // Trouver un seul bien
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM charges WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }

    // Créer
    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO charges
             (id_proprieté,type_depense,montant,date_depense,description)
             VALUES (:id_proprieté,:type_depense,:montant,:date_depense,:description)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE charges SET id_proprieté=:id_proprieté, type_depense=:type_depense,
             date_depense=:date_depense, description=:description WHERE id=:id'
        );
        return $s->execute($d);
    }

    // Supprimer
    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM charges WHERE id = ?'
        );
        return $s->execute([$id]);
    }
}