<?php
// app/models/bienimo.php

class Proprietaire {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre 
    public function findAll(?string $ville = null,?string $pays = null): array {
         if ($ville) {
            $s = $this->pdo->prepare(
                'SELECT * FROM proprietaire WHERE ville=? ORDER BY id ASC'
            );
            $s->execute([$ville]);
        } elseif($pays) {
            $s = $this->pdo->prepare(
                'SELECT * FROM proprietaire WHERE pays=? ORDER BY id ASC'
            );
            $s->execute([$pays]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM proprietaire ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }


    // Trouver un seul bien
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM proprietaire WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }

    // Créer
    public function create(array $d): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO utilisateur
             (id,user_id,addresse,ville,pays)
             VALUES (:id,:user_id,:addresse,:ville,:pays)'
        );
        $stmt->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $stmt = $this->pdo->prepare(
            'UPDATE proprietaire SET addresse=:addresse, ville=:ville,
             pays=:pays WHERE id=:id'
        );
        return $stmt->execute($d);
    }

    // Supprimer
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare(
            'DELETE FROM proprietaire WHERE id = ?'
        );
        $stmt2 = $this->pdo->prepare(
            'DELETE bienimo WHERE owner_id = ?'
        );
        $stmt2->execute([$id]);


        return $stmt->execute([$id]);
    }
}