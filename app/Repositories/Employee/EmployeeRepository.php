<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * Get all employees as a collection and paginated data, optionally filtering by name.
     *
     * @param string|null
     * @param int|null
     * @return array Contains two elements:
     *               - [0]: A collection of all matching employees.
     *               - [1]: Paginated data for the matching employees (4 per page).
     */
    public function getAll(?string $name = null, ?string $division_id = null)
    {
        $query = Employee::query();

        $query->when($name, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        });

        $query->when($division_id, function ($query, $division_id) {
            $query->where('division_id', '=', $division_id);
        });

        return [$query->get(), $query->paginate(8)];
    }

    /**
     * Create a new Employee record.
     *
     * @param array $data
     * @return Employee
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::create($data);
            DB::commit();
            return $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Failed to create employee' . $e->getMessage());
        }
    }

    /**
     * Update an existing Employee record.
     *
     * @param string $id
     * @param array $data
     * @return Employee
     */
    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($id);
            $employee->update($data);
            DB::commit();
            return $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Failed to update employee');
        }
    }

    /**
     * Delete an Employee record.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($id);
            $result = $employee->delete();
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Failed to delete employee');
        }
    }
}
