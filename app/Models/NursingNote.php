<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NursingNote extends Model
{
    protected $fillable = ['note', 'nurse_id'];
}

