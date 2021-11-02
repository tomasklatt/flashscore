<?php

namespace app;

require __DIR__ . '/../vendor/autoload.php';

use app\model\builders\TomasKlattBuilder;

class Application
{
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
        $person = (new TomasKlattBuilder())->getPerson()->save($this->db);
    }
}