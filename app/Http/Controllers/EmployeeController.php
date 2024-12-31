<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    protected $employeeRepository;
    protected $firebaseStorage;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->firebaseStorage = app('firebase');
    }

    public function getAllEmployees(Request $request)
    {
        try {
            $input = $request->validate([
                'name' => 'string|nullable',
                'division_id' => 'string|nullable|exists:divisions,id'
            ]);

            [$employees, $paginated] = $this->employeeRepository->getAll($input['name'] ?? null, $input['division_id'] ?? null);

            return response()->json([
                'status' => 'Success',
                'message' => 'Employees retrieved',
                'data' => [
                    'employees' => $employees,
                ],
                'pagination' => $paginated
            ], 200);
        } catch (\Exception $e) {
            // Return validation errors as a JSON response
            return response()->json([
                'status' => 'Unexpected error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function createEmployee(Request $request)
    {
        try {
            $input = $request->validate([
                'image' => 'image|required|mimes:jpeg,png,jpg|max:2048',
                'name' => 'string|required',
                'phone' => 'string|required',
                'division_id' => 'string|required|exists:divisions,id',
                'position' => 'string|required'
            ]);

            // Upload the image to firebase
            $file = $request->file('image');

            $bucket = $this->firebaseStorage->getBucket();
            $bucketName = $bucket->name();
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $object = $bucket->upload(fopen($file->getRealPath(), 'r'), [
                'name' => $fileName
            ]);

            $object->update(
                ['acl' => []],
                ['predefinedAcl' => 'PUBLICREAD']
            );

            $input['image'] = "https://storage.googleapis.com/{$bucketName}/{$fileName}";

            // Create employee
            $employee = $this->employeeRepository->create($input);

            if ($employee) {
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Employee added'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Cannot add employee'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return validation errors as a JSON response
            return response()->json([
                'status' => 'Unexpected error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateEmployee($employee_id, Request $request)
    {
        try {
            $input = $request->validate([
                'image' => 'image|nullable|mimes:jpeg,png,jpg|max:2048',
                'name' => 'string|required',
                'phone' => 'string|required',
                'division_id' => 'string|required|exists:divisions,id',
                'position' => 'string|required'
            ]);

            if ($request->hasFile('image')) { // Upload the image to firebase
                $file = $request->file('image');

                $bucket = $this->firebaseStorage->getBucket();
                $bucketName = $bucket->name();
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $object = $bucket->upload(fopen($file->getRealPath(), 'r'), [
                    'name' => $fileName
                ]);

                $object->update(
                    ['acl' => []],
                    ['predefinedAcl' => 'PUBLICREAD']
                );

                $input['image'] = "https://storage.googleapis.com/{$bucketName}/{$fileName}";
            }


            $employee = $this->employeeRepository->update($employee_id, $input);

            if ($employee) {
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Employee updated'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Cannot update employee'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return validation errors as a JSON response
            return response()->json([
                'status' => 'Unexpected error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteEmployee($employee_id)
    {
        try {
            $employee = $this->employeeRepository->delete($employee_id);

            if ($employee) {
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Employee deleted'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Cannot delete employee'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return validation errors as a JSON response
            return response()->json([
                'status' => 'Unexpected error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
