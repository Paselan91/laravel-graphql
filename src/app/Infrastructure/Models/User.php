<?php

declare(strict_types=1);

namespace App\Infrastructure\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\EmailVerifiedAt;
use App\Domain\User\ValueObject\EncriptedPassword;
use App\Domain\User\ValueObject\Name;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return UserEntity
     */
    public function toEntity(): UserEntity
    {
        return UserEntity::reconstruct(
            $this->id,
            new Name($this->name),
            new Email($this->email),
            new EmailVerifiedAt(CarbonImmutable::parse($this->email_verified_at)),
            new EncriptedPassword($this->password),
            null
        );
    }
}
