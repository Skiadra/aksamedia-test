<?php

namespace App\Repositories\Employee;

interface EmployeeRepositoryInterface
{
    public function getAll(?string $name, ?string $division_id);
    public function getById(string $id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
}
