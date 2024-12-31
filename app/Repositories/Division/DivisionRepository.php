<?php

namespace App\Repositories\Division;

use App\Models\Division;
use App\Repositories\Division\DivisionRepositoryInterface;

class DivisionRepository implements DivisionRepositoryInterface
{
    /**
     * Get all divisions as a collection and paginated data, optionally filtering by name.
     *
     * @param string|null $name Optional filter for divisions by name.
     * @return array Contains two elements:
     *               - [0]: A collection of all matching divisions.
     *               - [1]: Paginated data for the matching divisions (4 per page).
     */
    public function getAll(?string $name = null)
    {
        $query = Division::query();

        $query->when($name, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        });

        return [$query->get(), $query->paginate(4)];
    }
}
