<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_number',
        'country',
        'role_id',
        'is_admin',
        'status',
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
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Check if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true || ($this->role && $this->role->role_name === 'ADMIN');
    }

    // ── GMITE CORE RELATIONSHIPS ──────────────────────────────────
    public function role() { return $this->belongsTo(Role::class); }
    public function sessions() { return $this->hasMany(UserSession::class); }
    public function verificationTokens() { return $this->hasMany(VerificationToken::class); }
    public function notifications() { return $this->hasMany(Notification::class); }
    public function investorProfile() { return $this->hasOne(Investor::class); }

    // ── OPERATIONAL MODULES ───────────────────────────────────────
    public function companies() { return $this->hasMany(Company::class); }
    public function licenses() { return $this->hasMany(License::class); }
    public function mineralSamples() { return $this->hasMany(MineralSample::class); }
    public function certificates() { return $this->hasMany(Certificate::class); }
    public function tradeRequests() { return $this->hasMany(TradeRequest::class); }
    public function jointVentures() { return $this->hasMany(JointVenture::class); }
    public function alerts() { return $this->hasMany(SystemAlert::class); }
    public function auditLogs() { return $this->hasMany(AuditLog::class); }
}
