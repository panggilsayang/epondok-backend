<?php
declare(strict_types=1);
namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get user by email
     * @param string $value
     * @return User
     */
    public function getUserByEmail(string $value)
    {
        return User::query()->where(['email' => $value])->firstOrFail();
    }
}