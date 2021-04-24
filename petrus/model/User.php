<?php
namespace model;

use controller\Auth;
use Exception;

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

    private function validateFields($ignorepasswd = false) {
        // Username must have only word characteres and start with alphabetic
        if (!preg_match('/^[a-zA-Z]\w+$/', $this->username)) {
            throw new Exception('err_mfu: Malformed username');
        }
        // Username must have at least 4 characteres
        if (strlen($this->username) < 4) {
            throw new Exception('err_uts: Username too short');
        }
        // Password must have at least 8 characteres
        if (strlen($this->password) < 8 && !$ignorepasswd) {
            throw new Exception('err_pts: Password too short');
        }
        // User full name must have at least 3 characteres
        if (strlen($this->fullname) < 3) {
            throw new Exception('err_fns: Full name too short');
        }
    }

    public function create() {
        try {
            $this->validateFields();
        } catch (Exception $e) {
            throw $e;
        }
        if (Picture::gettemp()) {
            Picture::persist(Picture::gettemp(), $this->username);
        }
        $stmt = $this->conn->prepare(
            'INSERT INTO users (username, fullname, email, phone, isadm, passhash)
             VALUES (:username, :fullname, :email, :phone, :isadm, :passhash)'
        );
        foreach(['username', 'fullname', 'email', 'phone'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        $stmt->bindParam('isadm', $this->isadm, \PDO::PARAM_BOOL);
        $stmt->bindParam('passhash', hash('MD5', $this->password), \PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    /**
     * Updates user data. Only changes 'isadm' if request comes from an admin.
     * Gets all the data from the view (controller already passed it to us via
     * constructor), except the username (unchangeable) and the password, if not
     * changed.
     * @return null if unable to apply the changes
     */
    public function update() {
        try {
            $this->validateFields($this->password == '');
        } catch (Exception $e) {
            throw $e;
        }
        if (Picture::gettemp()) {
            Picture::persist(Picture::gettemp(), $this->username);
        }
        $changepasswd = (isset($this->password) && $this->password != '');
        $changeisadm  = Auth::getUserRole() == 'ADMIN';
        $stmt = $this->conn->prepare('UPDATE users SET (
            fullname,
            email,
            phone' .
            ($changeisadm  ? ',isadm' : '') .
            ($changepasswd ? ',passhash' : '') . '
        ) = (
            :fullname,
            :email,
            :phone' .
            ($changeisadm  ? ',:isadm' : '') .
            ($changepasswd ? ',:passhash' : '') . '
        ) WHERE username = :username');
        foreach(['username', 'fullname', 'email', 'phone'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        if ($changeisadm) {
            $stmt->bindParam('isadm', $this->isadm, \PDO::PARAM_BOOL);
        }
        if ($changepasswd) {
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
