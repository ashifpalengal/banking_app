<?php

namespace App\Traits;

use App\Models\Statement;

trait StatementsTrait
{
    public function recordStatement($data)
    {
        Statement::create($data);
    }
}
