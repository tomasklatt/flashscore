<?php

namespace app;

use app\model\entities\Person;
use SQLite3;

class Db extends SQLite3 {
    CONST DB_NAME = 'flashscore';

    function __construct() {
        parent::__construct(  __DIR__ . '/' . self::DB_NAME . '.db');
    }

    public function savePerson(Person $person){
        $stmt = $this->prepare('INSERT INTO person (name, email, phone, street, city) VALUES (:name, :email, :phone, :street, :city)');
        $stmt->bindValue(':name', $person->getName());
        $stmt->bindValue(':email', $person->getEmail());
        $stmt->bindValue(':phone', $person->getPhone());
        $stmt->bindValue(':street', $person->getStreet());
        $stmt->bindValue(':city', $person->getCity());
        $result = $stmt->execute();
        var_dump($result);
    }

    public function loadPersonById(int $id){
        $stmt = $this->prepare('SELECT * FROM person WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        var_dump($result);
    }
}