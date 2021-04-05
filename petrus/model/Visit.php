<?php
namespace model;

class Visit {

    private $id;
    private $visitorid;
    private $visitorname;
    private $arrival;
    private $departure;
    private $department;
    private $tag;

    private $conn;

    public function __construct($id=0, $visitorid=0, $visitorname=null, $arrival=null, $departure=null, $department=null, $tag=null) {
        $this->id = $id;
        $this->visitorid = $visitorid;
        $this->fullname = $fullname;
        $this->arrival = $arrival;
        $this->departure = $departure;
        $this->department = $department;
        $this->tag = $tag;
        $this->conn = Connection::getConnection();
    }

    public function __set(string $attr, $val) {
        $this->$attr = $val;
        return $this;
    }

    public static function readAll() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('
            SELECT visits.id,arrival,departure,department,tag,
              visitors.id AS visitorid,fullname AS visitorname
            FROM visits,visitors WHERE visitor_id=visitors.id
        ');
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function readOne($id) {
        $stmt = $this->conn->prepare('
            SELECT visits.id,arrival,departure,department,tag,
              visitors.id AS visitorid,fullname AS visitorname
            FROM visits,visitors WHERE visitor_id=:id AND visitor_id=visitors.id
        ');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->setFetchMode(\PDO::FETCH_INTO, $this);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function create() {
        $stmt = $this->conn->prepare(
            'INSERT INTO visits (arrival, departure, department, tag, visitor_id)
             VALUES (:arrival, :departure, :department, :tag, :visitorid)'
        );
        foreach(['arrival', 'departure', 'department', 'tag', 'visitorid'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public function update() {
        $stmt = $this->conn->prepare(
            'UPDATE visitors SET (arrival, departure, department, tag, visitor_id) =
            (:arrival, :departure, :department, :tag, :visitor_id) WHERE id = :id' 
        );
        foreach(['arrival', 'departure', 'department', 'tag', 'visitor_id'] as $param) {
            $stmt->bindParam($param, $this->$param, \PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function delete($id) {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('DELETE FROM visits WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
