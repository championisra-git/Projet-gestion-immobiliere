<?php

class Facture {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

   public function findAll(?string $statut = null): array {
         if ($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM facture WHERE statut=? ORDER BY id ASC'
            );
            $s->execute([$statut]);
         } else{
            $s = $this->pdo->query(
                'SELECT * FROM facture ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM facture WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }

    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO facture
             (id_loyer,date_facture,montant_total,montant_paye,statut)
             VALUES (:id_loyer,:date_facture,:montant_total,:montant_paye,:statut)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE facture SET id_loyer=:id_loyer, date_facture=:date_facture,
             montant_total=:montant_total,montant_paye=:montant_paye, statut=:statut WHERE id=:id'
        );
        return $s->execute($d);
    }

    // Supprimer
    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM facture WHERE id = ?'
        );
        return $s->execute([$id]);
    }
}