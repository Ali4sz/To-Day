<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_name',
        'due_date',
        'priority',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean',
    ];

    // Accessor to format due_date for display
    public function getFormattedDueDateAttribute()
    {
        if ($this->due_date) {
            return Carbon::parse($this->due_date)->format('M d, g:i A');
        }
        return 'No due date';
    }

    public function getDisplayDueDateStringAttribute()
    {
        if ($this->due_date->isToday()) {
            if ($this->due_date) {
                // $this->due_date is already a Carbon instance
                return 'Today, ' . $this->due_date->format('g:i A'); // e.g., Today, 5:00 PM
            } else {
                return 'Today'; // If it's for today but no specific time
            }
        } else {
            // For non-today tasks, use the existing formatted_due_date
            // This will call the getFormattedDueDateAttribute() accessor
            return $this->formatted_due_date;
        }
    }
}
