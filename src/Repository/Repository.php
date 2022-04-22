<?php
declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class Repository
{
    protected Connection $db;

    public function __construct($dbCredentials)
    {
        $this->db = DriverManager::getConnection($dbCredentials);
    }

}
