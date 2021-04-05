<?php
namespace model;

class Visitor {

    private $id;
    private $fullname;
    private $cpf;
    private $rg;
    private $email;
    private $phone;
    private $wpp;

    private $conn;

    public function __construct($id=0, $fullname=null, $cpf=null, $rg=null, $email=null, $phone=null, $wpp=null) {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->email = $email;
        $this->phone = $phone;
        $this->wpp = $wpp;
        $this->conn = Connection::getConnection();
    }

    public function __set(string $attr, $val) {
        $this->$attr = $val;
        return $this;
    }

    public static function readAll() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('SELECT * FROM visitors');
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function readOne($id) {
        $stmt = $this->conn->prepare('SELECT * FROM visitors WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->setFetchMode(\PDO::FETCH_INTO, $this);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function create() {
        $stmt = $this->conn->prepare(
            'INSERT INTO visitors (fullname, cpf, rg, email, phone, wpp)
             VALUES (:fullname, :cpf, :rg, :email, :phone, :wpp)'
        );
        foreach(['fullname', 'cpf', 'rg', 'email', 'phone', 'wpp'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function update() {
        $stmt = $this->conn->prepare(
            'UPDATE visitors SET (fullname, cpf, rg, email, phone, wpp) =
            (:fullname, :cpf, :rg, :email, :phone, :wpp) WHERE id = :id' 
        );
        foreach(['fullname', 'cpf', 'rg', 'email', 'phone', 'wpp', 'id'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function delete($id) {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('DELETE FROM visitors WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
