<?php

namespace App\Repositories;

use App\Models\Place;

class PlaceRepository extends AbstractRepository
{
    public function __construct(Place $place)
    {
        parent::__construct($place);
    }

    public function existsWithAttributes(array $attributes)
{
    $query = $this->model;

    foreach ($attributes as $key => $value) {
        $query = $query->where($key, $value);
    }

    return $query->exists();
}

}
