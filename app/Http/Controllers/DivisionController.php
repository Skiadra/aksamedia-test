<?php

namespace App\Http\Controllers;

use App\Repositories\Division\DivisionRepositoryInterface;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    protected $divisionRepository;

    public function __construct(DivisionRepositoryInterface $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function getAllDivisions(Request $request)
    {
        try {
            $input = $request->validate([
                'name' => 'string|nullable'
            ]);

            [$divisions, $paginated] = $this->divisionRepository->getAll($input['name'] ?? null);

            return response()->json([
                'status' => 'Success',
                'message' => 'Divisions rretrieved',
                'data' => [
                    'divisions' => $divisions,
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
}
