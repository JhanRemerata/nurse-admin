<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DutySchedule extends Model
{
    protected $fillable = ['nurse_id', 'duty_date', 'shift'];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
