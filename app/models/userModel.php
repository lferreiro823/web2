<?php

require_once 'app/models/model.php';

class UserModel extends Model {

    public function getByUser($usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE user = ?');
        $query->execute([$usuario]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}