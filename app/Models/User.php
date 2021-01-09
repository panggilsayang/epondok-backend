<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $deleted_at
 * @property Carbon $email_verified_at
 * @property Token $token
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var mixed[]|string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var mixed[]|string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>|mixed[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
