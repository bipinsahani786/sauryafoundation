<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Handle model event boot
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    /**
     * Log activity
     */
    protected function logActivity(string $event)
    {
        $oldValues = null;
        $newValues = null;

        if ($event === 'created') {
            $newValues = $this->getAuditAttributes();
        } elseif ($event === 'updated') {
            $oldValues = array_intersect_key($this->getOriginal(), $this->getDirty());
            $newValues = $this->getDirty();

            // Filter out sensitive fields
            $oldValues = $this->filterSensitiveFields($oldValues);
            $newValues = $this->filterSensitiveFields($newValues);
            
            if (empty($newValues)) return;
        } elseif ($event === 'deleted') {
            $oldValues = $this->getAuditAttributes();
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'subject_type' => get_class($this),
            'subject_id' => $this->id,
            'event' => $event,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Get attributes for auditing
     */
    protected function getAuditAttributes()
    {
        return $this->filterSensitiveFields($this->toArray());
    }

    /**
     * Filter sensitive fields like password
     */
    protected function filterSensitiveFields(array $data)
    {
        $sensitive = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];
        return array_diff_key($data, array_flip($sensitive));
    }
}
