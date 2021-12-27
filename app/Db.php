<?php declare(strict_types=1);

namespace app;

use app\exceptions\db\DbLoadException;
use app\exceptions\db\DbSaveException;
use app\model\builders\UniversalPersonBuilder;
use app\model\entities\Person;
use Exception;
use SQLite3;

class Db extends SQLite3 {
    const DB_NAME = 'flashscore';

    function __construct() {
        parent::__construct(  __DIR__ . '/' . self::DB_NAME . '.db');
        $this->enableExceptions(true);
    }

    public function savePerson(Person $person): void
    {
        try {
            $stmt = $this->prepare('INSERT INTO person (name, email, phone, street, city) VALUES (:name, :email, :phone, :street, :city)');
            if($stmt === false){
                throw new DbSaveException('Person wasn\'t saved.');
            }
            $stmt->bindValue(':name', $person->getName());
            $stmt->bindValue(':email', $person->getEmail());
            $stmt->bindValue(':phone', $person->getPhone());
            $stmt->bindValue(':street', $person->getStreet());
            $stmt->bindValue(':city', $person->getCity());
            $stmt->execute();
        } catch (Exception $e){
            throw new DbSaveException('Person wasn\'t saved.');
        }
    }

    public function loadPersonById(int $id): void
    {
        try {
            $stmt = $this->prepare('SELECT * FROM person WHERE id = :id');
            if($stmt === false){
                throw new DbLoadException('Person cannot be load.');
            }
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $result = $stmt->execute();
            if($result === false){
                throw new DbLoadException('Person cannot be load.');
            }
            $data = $result->fetchArray();
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
        } catch (Exception $e){
            throw new DbLoadException('Person cannot be load.');
        }
    }
}