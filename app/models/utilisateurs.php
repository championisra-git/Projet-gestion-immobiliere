<?php

class Utilisateur {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lister — avec filtre 
    public function findAll(): array {
        $stmt = $this->pdo->query(
            'SELECT * FROM utilisateur ORDER BY id ASC'
        );
    
        return $stmt->fetchAll();
    }
    public function findByRole(string $role): array {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM utilisateur WHERE role = ?'
        );
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }


    // Trouver un seul bien
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM utilisateur WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }

    // Créer
    public function create(array $d): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO utilisateur
             (id,nom,prenom,email,password,telephone,role,date_creation,actif)
             VALUES (:id,:nom,:prenom,:email,:password,:telephone,:role,:date_creation,:actif)'
        );
        $stmt->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    // Modifier
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $stmt = $this->pdo->prepare(
            'UPDATE utilisateur SET nom=:nom, prenom=:prenom,
             password=:password, telephone=:telephone, role=:role, actif=:actif WHERE id=:id'
        );
        return $stmt->execute($d);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare(
            'DELETE FROM utilisateur WHERE id = ?'
        );
        return $stmt->execute([$id]);
    }
}