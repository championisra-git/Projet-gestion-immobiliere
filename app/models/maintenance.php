<?php
// app/models/bienimo.php

class Charges {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre statut optionnel
   public function findAll(?string $id_loyé = null,?string $statut = null): array {
         if ($id_loyé) {
            $s = $this->pdo->prepare(
                'SELECT * FROM maintenance WHERE id_loyé=? ORDER BY id ASC'
            );
            $s->execute([$id_loyé]);
        } elseif($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM maintenance WHERE statut=? ORDER BY id ASC'
            );
            $s->execute([$statut]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM maintenance ORDER BY id ASC'
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

    public function findByloye(int $id_loyé){
        $s = $this->pdo->prepare(
            'SELECT * FROM maintenance WHERE id_loyé = ?'
        );
        $s->execute([$id_loyé]);
        return $s->fetch();
    }
    public function findOuverts(): array |false{
         $s = $this->pdo->prepare(
            'SELECT * FROM maintenance WHERE statut = ouvert'
        );
        return $s->fetch();
    }
    public function close(int $id): bool{
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE maintenace SET statut="resolu" WHERE id=?'
        );
        $s->execute($d);
        return $s->fetch();

    }

    // Créer
    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO maintenace
             (id_loyé,titre,urgence,statut,date_signalement,date_resolution,description)
             VALUES (:id_loyé,:titre,:urgence,:statut,:date_signalement,:date_resolution,:description)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE maintenace SET id_loyé=:id_loyé, titre=:titre, urgence=:urgence, 
             statut=:statut,date_signalement=:date_signalement,date_resolution=:date_resolution,description=:description WHERE id=:id'
        );
        return $s->execute($d);
    }

    // Supprimer
    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM maintenace WHERE id = ?'
        );
        return $s->execute([$id]);
    }
}