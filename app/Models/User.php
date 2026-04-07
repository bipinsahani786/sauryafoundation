<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Auditable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'teacher_id',
        'wallet_balance',
        'referred_by',
        'bank_name',
        'account_no',
        'ifsc_code',
        'account_holder_name',
        'kyc_status',
        'kyc_notes',
        'class_id',
        'commission_percent',
        'profile_photo_path',
    ];

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    public function isSalesAgent()
    {
        return $this->role === 'sales_agent';
    }

    public function isSyndicate()
    {
        return $this->role === 'syndicate';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isKycVerified()
    {
        return $this->kyc_status === 'verified';
    }

    public function payoutRequests()
    {
        return $this->hasMany(PayoutRequest::class);
    }

    // Hierarchy Relationships
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    // Wallet Logic
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->permissions->contains('name', $permission);
    }

    public function deposit($amount, $source_type = null, $source_id = null, $description = null)
    {
        $this->increment('wallet_balance', $amount);
        return $this->transactions()->create([
            'amount' => $amount,
            'type' => 'credit',
            'source_type' => $source_type,
            'source_id' => $source_id,
            'description' => $description,
            'status' => 'completed',
        ]);
    }

    public function withdraw($amount, $source_type = null, $source_id = null, $description = null)
    {
        if ($this->wallet_balance < $amount) {
            throw new \Exception('Insufficient wallet balance.');
        }
        $this->decrement('wallet_balance', $amount);
        return $this->transactions()->create([
            'amount' => $amount,
            'type' => 'debit',
            'source_type' => $source_type,
            'source_id' => $source_id,
            'description' => $description,
            'status' => 'completed',
        ]);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

    public function quizEnrollments()
    {
        return $this->hasMany(QuizEnrollment::class, 'student_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
                    ->using(CourseUser::class)
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }

    public function contentCompletions()
    {
        return $this->hasMany(ContentCompletion::class);
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
        ];
    }
}
