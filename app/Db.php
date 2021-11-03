<?php

namespace app;

use app\exceptions\db\DbLoadException;
use app\exceptions\db\DbSaveException;
use app\model\builders\UniversalPersonBuilder;
use app\model\entities\Person;
use SQLite3;

class Db extends SQLite3 {
    CONST DB_NAME = 'flashscore';

    function __construct() {
        parent::__construct(  __DIR__ . '/' . self::DB_NAME . '.db');
        $this->enableExceptions(true);
    }

    public function savePerson(Person $person){
        try {
            $stmt = $this->prepare('INSERT INTO person (name, email, phone, street, city) VALUES (:name, :email, :phone, :street, :city)');
            $stmt->bindValue(':name', $person->getName());
            $stmt->bindValue(':email', $person->getEmail());
            $stmt->bindValue(':phone', $person->getPhone());
            $stmt->bindValue(':street', $person->getStreet());
            $stmt->bindValue(':city', $person->getCity());
            $stmt->execute();
        } catch (\Throwable $t){
            throw new DbSaveException('Person wasn\'t saved.');
        }
    }

    public function loadPersonById(int $id){
        try {
            $stmt = $this->prepare('SELECT * FROM person WHERE id = :id');
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $data = $stmt->execute()->fetchArray();
            if($data === false){
                throw new DbLoadException('Person cannot be load.');
            }
            new UniversalPersonBuilder(
                name: $data['name'],
                email: $data['email'],
                phone: $data['phone'],
                street: $data['street'],
                city: $data['city'],
                id: $data['id']
            );
        } catch (\Throwable $t){
            throw new DbLoadException('Person cannot be load.');
        }
    }
}