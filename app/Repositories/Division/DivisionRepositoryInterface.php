<?php

namespace App\Repositories\Division;

interface DivisionRepositoryInterface
{
    public function getAll(?string $name = null);
}
