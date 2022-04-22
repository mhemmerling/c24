<?php
declare(strict_types=1);

namespace App\Controller;

class ResourceNotFoundException extends \Exception implements \Throwable
{
    protected $code = 40400;
}