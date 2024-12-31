<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required|string|exists:users,username',
                'password' => 'required',
            ]);

            // Attempt to log the user in
            if ($token = JWTAuth::attempt($credentials)) {
                // Authentication passed 
                $user = auth()->user();

                return response()->json([
                    'status' => 'Success',
                    'message' => 'Login success',
                    'data' => [
                        'token' => $token,
                        'admin' => $user
                    ]
                ], 200);
            } else {
                // Authentication failed
                throw ValidationException::withMessages([
                    'login_error' => 'Invalid credentials',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ], 401);
        } catch (\Exception $e) {
            // Return validation errors as a JSON response
            return response()->json([
                'status' => 'Unexpected error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Log out the authenticated user.
     *
     * @return json
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'status' => 'Success',
                'message' => 'Logout success'
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
