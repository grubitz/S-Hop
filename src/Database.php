<?php

namespace Grubitz;

use PDO;

class Database extends PDO
{
    public function __construct()
    {
        parent::__construct($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
