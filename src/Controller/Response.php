<?php
declare(strict_types=1);

namespace App\Controller;

interface Response
{
    public function view(): string;
}