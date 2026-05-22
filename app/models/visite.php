<?php

class Visite{

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

   public function findAll(?string $id_proprieté = null,?string $statut = null): array {
         if ($id_proprieté) {
            $s = $this->pdo->prepare(
                'SELECT * FROM visite WHERE id_proprieté=? ORDER BY id ASC'
            );
            $s->execute([$id_proprieté]);
        } elseif($statut) {
            $s = $this->pdo->prepare(
                'SELECT * FROM visite WHERE statut=? ORDER BY id ASC'
            );
            $s->execute([$statut]);
        }else{
            $s = $this->pdo->query(
                'SELECT * FROM visite ORDER BY id ASC'
            );
        }
        return $s->fetchAll();
    }
    public function findById(int $id): array|false {
        $s = $this->pdo->prepare(
            'SELECT * FROM visite WHERE id = ?'
        );
        $s->execute([$id]);
        return $s->fetch();
    }

    public function findbybienimo(int $id_proprieté): array |false{
         $s = $this->pdo->prepare(
            'SELECT * FROM visite WHERE id_proprieté = ? '
        );
        $s->execute([$id_proprieté]);
        return $s->fetch();
    }
    public function plan(int $id): bool{
        $s = $this->pdo->prepare(
            'UPDATE visite SET statut = ? WHERE id = ?'
        );
        return $s->execute(['Planifiée', $id]);

    }
     public function cancel(int $id): bool{
        $s = $this->pdo->prepare(
            'UPDATE visite SET statut = ? WHERE id = ?'
        );
        return $s->execute(['annulée', $id]);

    }
     public function effec(int $id): bool{
        $s = $this->pdo->prepare(
            'UPDATE visite SET statut = ? WHERE id = ?'
        );
        return $s->execute(['effectuée', $id]);

    }

    public function create(array $d): int {
        $s = $this->pdo->prepare(
            'INSERT INTO visite
             (id_proprieté,nom_visiteur,telephone_visiteur,email_visiteur,date_visite,statut,note_agent)
             VALUES (:id_proprieté,:nom_visiteur,:telephone_visiteur,:email_visiteur,:date_visite,:statut,:note_agent)'
        );
        $s->execute($d);
        return (int) $this->pdo->lastInsertId();
    }

    
    public function update(int $id, array $d): bool {
        $d['id'] = $id;
        $s = $this->pdo->prepare(
            'UPDATE visite SET id_proprieté=:id_proprieté, nom_visiteur=:nom_visiteur, telephone_visiteur=:telephone_visiteur, 
             email_visiteur=:email_visiteur,date_visite=:date_visite,statut=:statut,note_agent=:note_agent WHERE id=:id'
        );
        return $s->execute($d);
    }
    public function delete(int $id): bool {
        $s = $this->pdo->prepare(
            'DELETE FROM visite WHERE id = ?'
        );
        return $s->execute([$id]);
    }
}