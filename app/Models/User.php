<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_REGISTRAR = 'registrar';
    public const ROLE_CASHIER = 'cashier';
    public const ROLE_STUDENT = 'student';
    public const ROLE_DEPARTMENT = 'department';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'office',
        'registration_type',
        'contact_number',
        'student_id',
        'course',
        'year_graduated',
        'organization',
        'address',
        'purpose',
        'relationship_to_student',
        'student_full_name',
        'password',
        'is_active',
    ];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isRegistrar(): bool
    {
        return $this->role === self::ROLE_REGISTRAR;
    }

    public function isCashier(): bool
    {
        return $this->role === self::ROLE_CASHIER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isDepartment(): bool
    {
        return $this->role === self::ROLE_DEPARTMENT;
    }

    /**
     * Office this staff account manages. Defaults to the Registrar office.
     */
    public function officeScope(): string
    {
        return $this->office ?? 'Registrar';
    }

    /**
     * Effective role used by the sidebar/top-bar label. Alumni/parent/guest
     * keep the underlying 'student' role in the DB (middleware still checks
     * $this->role) but are surfaced here as their registration type so the
     * sidebar can branch on a real 'alumni'|'parent'|'guest' role value.
     */
    public function roleRule(): string
    {
        return match ($this->registration_type) {
            'alumni' => 'alumni',
            'parent', 'guardian' => 'parent',
            'guest' => 'guest',
            default => $this->role ?: 'student',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function studentProfile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function documentRequests(): HasMany
    {
        return $this->hasMany(DocumentRequest::class);
    }

    public function gateLogs(): HasMany
    {
        return $this->hasMany(GateLog::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'user_id');
    }

    public function feedbacks(): MorphMany
    {
        return $this->morphMany(Feedback::class, 'feedbackable');
    }

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
            'is_active' => 'boolean',
        ];
    }
}
