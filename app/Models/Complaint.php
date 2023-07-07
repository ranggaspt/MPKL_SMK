<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'instance_id',
        'student_id',
        'message_complaint',
        'validation_message'
    ];

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
    public function instance(){
        return $this->belongsTo('App\Models\Instance');
    }
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
}
