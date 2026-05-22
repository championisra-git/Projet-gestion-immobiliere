<?php
// app/models/bienimo.php

class Contract_location {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre statut optionnel
   public function findAll(?string $statut = null): array {
         if ($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM contrat_location WHERE statut=? ORDER BY id ASC'
            );
            $s->execute([$statut]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM contrat_location ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }
    // Trouver un seul bien
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM contrat_location WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }
    public function findByTenant(int $id_locataire): array|false{
       $s = $this->pdo->prepare(
            'SELECT * FROM contrat_location WHERE id_locataire = ?'
        );
        $s->execute([$id_locataire]);
        return $s->fetch();  
    }
    public function findByProperty(int $id_proprieté): array|false{
        $s = $this->pdo->prepare(
            'SELECT * FROM contrat_location WHERE id_proprieté = ?'
        );
        $s->execute([$id_proprieté]);
        return $s->fetch();  
    }
    public function findActifs(): array {
         $s = $this->pdo->prepare(
            'SELECT * FROM contrat_location WHERE statut = "actifs"'
        );
        $s->execute();
        return $s->fetchAll();
    }

    // Créer
    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO contrat_location
             (id_proprieté,id_locataire,date_debut,date_fin,loyer_mensuel,caution,statut,description)
             VALUES (:id_proprieté,:id_locataire,:date_debut,:date_fin,:loyer_mensuel,:caution,:statut,:description)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE contrat_location SET id_proprieté=:id_proprieté,id_locataire=:id_locataire,date_debut=:date_debut,
             date_fin=:date_fin, description=:description WHERE id=:id'
        );
        return $s->execute($d);
    }

    // Supprimer
    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM contrat_location WHERE id = ?'
        );
        return $s->execute([$id]);
    }

}