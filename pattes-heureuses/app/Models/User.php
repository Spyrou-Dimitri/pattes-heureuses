<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'avatar',
        'last_name',
        'first_name',
        'email',
        'password',
        'telephone',
        'role',
        'sexe',
        'disponibilities'
    ];

    protected $casts = [
        'sexe' => SexeVolunteer::class,
        'role' => RoleVolunteer::class,
        'disponibilities' => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleVolunteer::Admin;
    }

    public function isVolunteer(): bool
    {
        return $this->role === RoleVolunteer::Volunteer;
    }


    //Lorsque je crée un user, il a automatiquement cette horaire
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->disponibilities)) {
                $user->disponibilities = [
                    'monday' => ['morning' => false, 'afternoon' => false],
                    'tuesday' => ['morning' => false, 'afternoon' => false],
                    'wednesday' => ['morning' => false, 'afternoon' => false],
                    'thursday' => ['morning' => false, 'afternoon' => false],
                    'friday' => ['morning' => false, 'afternoon' => false],
                    'saturday' => ['morning' => false, 'afternoon' => false],
                    'sunday' => ['morning' => false, 'afternoon' => false],
                ];
            }
        });
    }


}
