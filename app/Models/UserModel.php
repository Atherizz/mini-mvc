<?php

class UserModel extends Model {

    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail($user) {
        $email = $user['email'];
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkCredential($user) {
        $password = $user['password'];
        $result = $this->getByEmail($user);
        if ($result && password_verify($password, $result['password'])) {
            return $result;
        } 
        return false;
    }

    public function registerUser($data) {
        $query = $this->db->prepare("INSERT INTO users (nama, email, password) VALUES (:nama, :email, :password)");
        $hashedPassword = password_hash($data['password'],PASSWORD_BCRYPT); 
        return $query->execute(['nama' => $data['nama'], 'email' => $data['email'], 'password' => $hashedPassword]);
    }

    public function createUser($nama, $email, $password, $role) {
        $query = $this->db->prepare("INSERT INTO users (nama, email, password, role) VALUES (:nama, :email, :password, :role)");
        return $query->execute(['nama' => $nama, 'email' => $email, 'password' => $password, 'role' => $role]);
    }
}
