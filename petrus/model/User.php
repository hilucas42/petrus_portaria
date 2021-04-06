<?php
namespace model;

class User {

    private $username;
    private $password;
    private $fullname;
    private $email;
    private $phone;
    private $isadm;

    private $passhash;
    private $conn;

    public function __construct($username=null, $password=null, $fullname=null, $email=null, $phone=null, $isadm=false) {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->isadm = $isadm;
        $this->passhash = null;
        $this->conn = Connection::getConnection();
    }

    public function __set(string $attr, $val) {
        $this->$attr = $val;
        return $this;
    }

    public function __get(string $attr) {
        return $this->$attr;
    }

    public static function readAll() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('SELECT * FROM users');
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function readOne($username) {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam('username', $username, \PDO::PARAM_INT);
        $stmt->setFetchMode(\PDO::FETCH_INTO, $this);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function create() {
        $stmt = $this->conn->prepare(
            'INSERT INTO users (username, fullname, email, phone, isadm, passhash)
             VALUES (:username, :fullname, :email, :phone, :isadm, :passhash)'
        );
        foreach(['username', 'fullname', 'email', 'phone', 'isadm'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        $stmt->bindParam('passhash', hash('MD5', $this->password), \PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function update() {
        if (is_null($this->password)) {
            $stmt = $this->conn->prepare(
                'UPDATE users SET (fullname, email, phone, isadm) =
                (:fullname, :email, :phone, :isadm) WHERE username = :username' 
            );
            foreach(['username', 'fullname', 'email', 'phone', 'isadm'] as $param) {
                $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
            }
        } else {
            $stmt = $this->conn->prepare(
                'UPDATE users SET (fullname, email, phone, isadm, passhash) =
                (:fullname, :email, :phone, :isadm, :passhash) WHERE username = :username' 
            );
            foreach(['username', 'fullname', 'email', 'phone', 'isadm'] as $param) {
                $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
            }
            $passhash = hash('MD5', $this->password);
            $stmt->bindParam('passhash', $passhash, \PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function delete($username) {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('DELETE FROM users WHERE username = :username');
        $stmt->bindParam('username', $username, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function validateLogin() {
        if (is_null($this->readOne($this->username))) {
            return false;
        }
        if (hash('MD5', $this->password) != $this->passhash) {
            return false;
        }
        return $this;
    }
}
