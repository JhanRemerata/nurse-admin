<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = ['nurse_id', 'leave_date', 'reason', 'status'];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}

