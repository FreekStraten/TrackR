<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
     * Class User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property int $user_role
     *
     *
     * @package App\Models
     */

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $casts = [
        'user_role' => 'int'
    ];

    protected $dates = [
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'user_role'
    ];

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'user_role');
    }

    public function isSuperAdmin() : bool {
        return $this->user_role == 1;
    }

    public function isUser() :bool {
        return $this->user_role == 2;
    }
}
