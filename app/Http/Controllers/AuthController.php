<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

use Neomerx\JsonApi\Exceptions\JsonApiException;
use CloudCreativity\LaravelJsonApi\Document\Error;

class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|string|max:4',
            'address' => 'required|string',
            'phone' => 'required|string|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $json_errors = $this->buildErrorJson($errors);

           return response()->json($json_errors, 422);

        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password'=> $request->password,
            'role' => $request->role
         ]);

        $token = auth()->claims(['role' => $user->role])->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function token()
    {
        $credentials = request(['email', 'password']);

        $user = User::GetUserByEmail($credentials['email'])->first();

        if (! $token = auth()->claims(['role' => $user->role])->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $payload = auth()->payload();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'role' => $payload->get('role')
        ]);
    }

    public function buildErrorJson($errors){
        $json_errors = [
            "errors" => [$errors]
        ];

        return $json_errors;
    }
}
