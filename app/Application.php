<?php declare(strict_types=1);

namespace app;

require __DIR__ . '/../vendor/autoload.php';

use app\model\builders\TomasKlattBuilder;
use app\model\entities\Person;

class Application
{
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
        (new TomasKlattBuilder())->getPerson()->save($this->db);
        Person::load($this->db, 99);
    }
}