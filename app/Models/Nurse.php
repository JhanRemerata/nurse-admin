<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    protected $fillable = ['name', 'age', 'position', 'gender'];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
