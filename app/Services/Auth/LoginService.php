<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\BaseServiceException;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\PersonalAccessTokenResult;

class LoginService
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(array $data): array
    {
        $user = $this->userService->getUserByEmail($data['username']);
        if (Hash::check($data['password'], $user->password)) {
            return $this->successLoginResponse($user);
        }
        throw new BaseServiceException('Something bad is happen....');
    }

    public function successLoginResponse(User $user): array
    {
        $token = $this->generateAuthToken($user);

        return [
            'id' => $user->id,
            'email' => $user->email,
            'token' => $token->accessToken,
            'token_expired_at' => $token->token->expires_at,
        ];
    }

    public function generateAuthToken(User $user): PersonalAccessTokenResult
    {
        return $user->createToken(config('auth.passport_token_name'));
    }

    protected function isEmail(string $value): bool
    {
        return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
