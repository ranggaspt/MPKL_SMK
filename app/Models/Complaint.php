<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'instance_id',
        'teacher_id', 
        'complaint_message',
        'validation_message'
    ];

    public function compalint()
    {
        return $this->hasOne('App\Models\Teacher');
    }
    
    public function compalintI()
    {
        return $this->hasOne('App\Models\Instance');
    }
}
