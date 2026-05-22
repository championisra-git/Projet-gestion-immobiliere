<?php

class Paiement {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(?string $statut = null): array {
         if ($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM paiement WHERE statut=? ORDER BY id ASC'
            );
            $s->execute([$statut]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM paiement ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }
     public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM paiement WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }
    public function findparloyer(int $id_loyer): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM paiement WHERE id_loyer = ?'
        );
        $s->execute([$id_loyer]);
        return $s->fetch();
    }
    public function findEnRetard(): array|false{
       $s = $this->pdo->prepare(
            'SELECT * FROM paiement WHERE statut = ?'
        );
        $s->execute(['en retard']);
        return $s->fetchAll();  
    }
    public function totalparloyer(int $id_loyer): array|false{
        $s = $this->pdo->prepare(
            'SELECT SUM(montant) as totalduloyer FROM paiement WHERE id_loyer= ?'
        );
        $s->execute([$id_loyer]);
        return $s->fetch();  
    }   

    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO paiement
             (id_loyer,mois_concerne,montant,date_paiement,mode_paiement,statut)
             VALUES (:id_loyer,:mois_concerne,:montant,:date_paiement,:mode_paiement,:statut)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE paiement SET id_loyer=:id_loyer,mois_concerne=:mois_concerne,date_paiement=:date_paiement,
             mode_paiement=:mode_paiement, statut=:statut WHERE id=:id'
        );
        return $s->execute($d);
    }

    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM paiement WHERE id = ?'
        );
        return $s->execute([$id]);
    }

}