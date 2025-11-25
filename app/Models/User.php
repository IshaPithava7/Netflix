<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Models\Role;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users')
            ->withTimestamps();
    }

    // Check if user has a role
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function myListVideos()
    {
        return $this->belongsToMany(
            Video::class,
            'my_list',
            'user_id',
            'video_id'
        )->withTimestamps();
    }

    public function CustomeSubscription()
    {
        return $this->hasMany(CustomeSubscription::class);
    }

    protected static function booted()
    {
        static::deleting(function ($user) {

            // Soft delete pivot if not force deleting
            if (!$user->isForceDeleting()) {
                $user->roles()->updateExistingPivot(
                    $user->roles->pluck('id'),
                    ['deleted_at' => now()]
                );
            } else {
                // If force delete → remove pivot completely
                $user->roles()->detach();
            }
        });

        static::restoring(function ($user) {
            // Restore pivot roles
            $user->roles()->withTrashed()->updateExistingPivot(
                $user->roles->withTrashed()->pluck('id'),
                ['deleted_at' => null]
            );
        });
    }

}
