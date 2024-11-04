<?php

declare(strict_types=1);

namespace App\Enums;

enum ExampleEnum: string
{
    case Bearer_Auth = 'Bearer-Auth';
    case Basic_Auth = 'Basic-Auth';
    case Digest_Auth = 'Digest-Auth';
}
