<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ConsultationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'car_id',
        'name',
        'phone',
        'email',
        'note',
        'source',
        'preferred_contact_time',
        'status',
        'assigned_to',
        'contacted_at',
        'closed_at',
        'internal_note', // Thêm field này nếu có trong form
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
        'closed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
        'source' => 'website',
    ];

    // Validation rules
    public static $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|regex:/^(0[3|5|7|8|9])+([0-9]{8})$/',
        'email' => 'nullable|email|max:255',
        'source' => 'required|in:website,facebook,zalo,offline,other',
        'status' => 'required|in:pending,contacted,in_progress,closed',
        'preferred_contact_time' => 'nullable|in:morning,afternoon,evening,anytime,weekend',
        'user_id' => 'nullable|exists:users,id',
        'car_id' => 'nullable|exists:cars,id',
        'assigned_to' => 'nullable|exists:users,id',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-update timestamps when status changes
        static::updating(function ($consultationRequest) {
            if ($consultationRequest->isDirty('status')) {
                switch ($consultationRequest->status) {
                    case 'contacted':
                        if (!$consultationRequest->contacted_at) {
                            $consultationRequest->contacted_at = now();
                        }
                        break;
                    case 'closed':
                        if (!$consultationRequest->closed_at) {
                            $consultationRequest->closed_at = now();
                        }
                        break;
                }
            }
        });

        // Auto-generate reference number if needed
        static::creating(function ($consultationRequest) {
            // You can add reference number generation logic here
            // $consultationRequest->reference = 'CR' . date('Ymd') . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    // ===================
    // RELATIONSHIPS
    // ===================

    /**
     * Get the user that made this consultation request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car that this consultation is about.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the user assigned to handle this consultation.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Alias for assignedTo relationship.
     */
    public function consultant(): BelongsTo
    {
        return $this->assignedTo();
    }

    // ===================
    // QUERY SCOPES
    // ===================

    /**
     * Scope a query to only include pending requests.
     */
    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include contacted requests.
     */
    public function scopeContacted(Builder $query): void
    {
        $query->where('status', 'contacted');
    }

    /**
     * Scope a query to only include in progress requests.
     */
    public function scopeInProgress(Builder $query): void
    {
        $query->where('status', 'in_progress');
    }

    /**
     * Scope a query to only include closed requests.
     */
    public function scopeClosed(Builder $query): void
    {
        $query->where('status', 'closed');
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus(Builder $query, string $status): void
    {
        $query->where('status', $status);
    }

    /**
     * Scope a query to filter by source.
     */
    public function scopeBySource(Builder $query, string $source): void
    {
        $query->where('source', $source);
    }

    /**
     * Scope a query to only include requests from today.
     */
    public function scopeToday(Builder $query): void
    {
        $query->whereDate('created_at', today());
    }

    /**
     * Scope a query to only include requests from this week.
     */
    public function scopeThisWeek(Builder $query): void
    {
        $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    /**
     * Scope a query to only include requests from this month.
     */
    public function scopeThisMonth(Builder $query): void
    {
        $query->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);
    }

    /**
     * Scope a query to search by customer info.
     */
    public function scopeSearchCustomer(Builder $query, string $search): void
    {
        $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to filter by assigned consultant.
     */
    public function scopeAssignedTo(Builder $query, int $userId): void
    {
        $query->where('assigned_to', $userId);
    }

    /**
     * Scope a query to only include unassigned requests.
     */
    public function scopeUnassigned(Builder $query): void
    {
        $query->whereNull('assigned_to');
    }

    /**
     * Scope a query to only include requests with user accounts.
     */
    public function scopeHasAccount(Builder $query): void
    {
        $query->whereNotNull('user_id');
    }

    /**
     * Scope a query to only include walk-in customers.
     */
    public function scopeWalkIn(Builder $query): void
    {
        $query->whereNull('user_id');
    }

    /**
     * Scope a query to only include contacted requests.
     */
    public function scopeContactedRequests(Builder $query): void
    {
        $query->whereNotNull('contacted_at');
    }

    /**
     * Scope a query to only include requests needing follow-up.
     */
    public function scopeNeedsFollowUp(Builder $query): void
    {
        $query->where('status', '!=', 'closed')
              ->where(function ($query) {
                  $query->whereNull('contacted_at')
                        ->orWhere('contacted_at', '<', now()->subDays(3));
              });
    }

    // ===================
    // ACCESSORS & MUTATORS
    // ===================

    /**
     * Get the customer's display name.
     */
    public function getCustomerNameAttribute(): string
    {
        return $this->user ? $this->user->name : $this->name;
    }

    /**
     * Get the formatted phone number.
     */
    public function getFormattedPhoneAttribute(): string
    {
        $phone = $this->phone;
        return substr($phone, 0, 4) . ' ' . substr($phone, 4, 3) . ' ' . substr($phone, 7);
    }

    /**
     * Get the masked phone number for display.
     */
    public function getMaskedPhoneAttribute(): string
    {
        return substr($this->phone, 0, 4) . '***' . substr($this->phone, -3);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Chờ xử lý',
            'contacted' => 'Đã liên hệ',
            'in_progress' => 'Đang tư vấn',
            'closed' => 'Đã đóng',
            default => $this->status,
        };
    }

    /**
     * Get the source label.
     */
    public function getSourceLabelAttribute(): string
    {
        return match ($this->source) {
            'website' => 'Website',
            'facebook' => 'Facebook',
            'zalo' => 'Zalo',
            'offline' => 'Showroom',
            'other' => 'Khác',
            default => $this->source,
        };
    }

    /**
     * Get the preferred contact time label.
     */
    public function getPreferredContactTimeLabelAttribute(): ?string
    {
        return match ($this->preferred_contact_time) {
            'morning' => 'Buổi sáng',
            'afternoon' => 'Buổi chiều',
            'evening' => 'Buổi tối',
            'anytime' => 'Bất cứ lúc nào',
            'weekend' => 'Cuối tuần',
            default => null,
        };
    }

    /**
     * Get the car information.
     */
    public function getCarInfoAttribute(): ?string
    {
        if (!$this->car) {
            return null;
        }

        $info = $this->car->title;
        if ($this->car->brand) {
            $info .= ' - ' . $this->car->brand->name;
        }
        if ($this->car->price) {
            $info .= ' (' . number_format($this->car->price) . '₫)';
        }

        return $info;
    }

    /**
     * Get days since creation.
     */
    public function getDaysSinceCreatedAttribute(): int
    {
        return $this->created_at->diffInDays(now());
    }

    /**
     * Get days since last contact.
     */
    public function getDaysSinceContactAttribute(): ?int
    {
        return $this->contacted_at?->diffInDays(now());
    }

    /**
     * Check if request is overdue (needs attention).
     */
    public function getIsOverdueAttribute(): bool
    {
        if ($this->status === 'closed') {
            return false;
        }

        // If not contacted after 1 day
        if (!$this->contacted_at && $this->created_at->lt(now()->subDay())) {
            return true;
        }

        // If contacted but no progress after 3 days
        if ($this->contacted_at && $this->contacted_at->lt(now()->subDays(3)) && $this->status !== 'in_progress') {
            return true;
        }

        return false;
    }

    /**
     * Get priority level based on various factors.
     */
    public function getPriorityAttribute(): string
    {
        // High priority if expensive car or VIP customer
        if ($this->car && $this->car->price > 2000000000) {
            return 'high';
        }

        // High priority if overdue
        if ($this->is_overdue) {
            return 'high';
        }

        // Medium priority if has account or specific car interest
        if ($this->user_id || $this->car_id) {
            return 'medium';
        }

        return 'normal';
    }

    // ===================
    // HELPER METHODS
    // ===================

    /**
     * Mark as contacted.
     */
    public function markAsContacted(?Carbon $contactedAt = null): bool
    {
        return $this->update([
            'status' => 'contacted',
            'contacted_at' => $contactedAt ?? now(),
        ]);
    }

    /**
     * Mark as in progress.
     */
    public function markAsInProgress(): bool
    {
        return $this->update([
            'status' => 'in_progress',
        ]);
    }

    /**
     * Mark as closed.
     */
    public function markAsClosed(?Carbon $closedAt = null): bool
    {
        return $this->update([
            'status' => 'closed',
            'closed_at' => $closedAt ?? now(),
        ]);
    }

    /**
     * Assign to a consultant.
     */
    public function assignTo(User $user): bool
    {
        return $this->update(['assigned_to' => $user->id]);
    }

    /**
     * Check if request can be edited.
     */
    public function canBeEdited(): bool
    {
        return $this->status !== 'closed';
    }

    /**
     * Check if request can be assigned.
     */
    public function canBeAssigned(): bool
    {
        return $this->status !== 'closed' && !$this->assigned_to;
    }

    /**
     * Get timeline of activities.
     */
    public function getTimelineAttribute(): array
    {
        $timeline = [];

        $timeline[] = [
            'event' => 'created',
            'label' => 'Yêu cầu được tạo',
            'date' => $this->created_at,
            'icon' => 'heroicon-m-plus-circle',
            'color' => 'primary',
        ];

        if ($this->contacted_at) {
            $timeline[] = [
                'event' => 'contacted',
                'label' => 'Đã liên hệ khách hàng',
                'date' => $this->contacted_at,
                'icon' => 'heroicon-m-phone',
                'color' => 'success',
            ];
        }

        if ($this->assigned_to) {
            $timeline[] = [
                'event' => 'assigned',
                'label' => 'Đã phân công cho ' . $this->assignedTo->name,
                'date' => $this->updated_at, // Assume assignment happened on last update
                'icon' => 'heroicon-m-user-plus',
                'color' => 'info',
            ];
        }

        if ($this->closed_at) {
            $timeline[] = [
                'event' => 'closed',
                'label' => 'Yêu cầu đã được đóng',
                'date' => $this->closed_at,
                'icon' => 'heroicon-m-check-circle',
                'color' => 'success',
            ];
        }

        // Sort by date
        usort($timeline, fn ($a, $b) => $a['date']->lt($b['date']) ? -1 : 1);

        return $timeline;
    }

    // ===================
    // STATIC METHODS
    // ===================

    /**
     * Get statistics.
     */
    public static function getStats(): array
    {
        return [
            'total' => static::count(),
            'pending' => static::pending()->count(),
            'contacted' => static::contacted()->count(),
            'in_progress' => static::inProgress()->count(),
            'closed' => static::closed()->count(),
            'today' => static::today()->count(),
            'this_week' => static::thisWeek()->count(),
            'this_month' => static::thisMonth()->count(),
            'unassigned' => static::unassigned()->count(),
            'overdue' => static::where(function ($query) {
                $query->whereNull('contacted_at')
                      ->where('created_at', '<', now()->subDay())
                      ->where('status', '!=', 'closed');
            })->count(),
        ];
    }
}