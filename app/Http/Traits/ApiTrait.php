<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Http\Response;

trait ApiTrait
{
    /**
     * validation arrays used in making sure user
     * requests have data that comforms to these rules
     */

    protected function userRegistrationValidation(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function userLoginValidation(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }


    /**
     * returns a User Object after using passed values to
     * create a user record in the 'users' table
     */

    protected function saveUser($user_data): User
    {
        $user = new User;
        $user->name = $user_data['name'];
        $user->email = $user_data['email'];
        $user->password = $user_data['password'];
        $user->user_group_id = $user_data['user_group_id'];
        $user->save();

        return $user;
    }


    /**
     * token generator
     */

    protected function generateUserToken(User $user, string $token_name): string
    {
        $token = $user->createToken($token_name)->plainTextToken;
        return $token;
    }


    /**
     * a uniform response method
     */

    protected function apiResponse(string $message, string $remark = '', $data, $errors, int $statusCode = 200): Response
    {
        return response([
            'statusCode' => $statusCode,
            'message' => $message,
            'remark' => $remark,
            'data' => $data,
            'errors' => $errors,
        ], $statusCode);
    }
}
