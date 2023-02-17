<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    public function find(int $id);
    public function create(array $attributes);
}
