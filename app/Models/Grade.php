<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'instance_id',
        'teacher_id',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'ratarata',
    ];

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }

    public function student(){
        return $this->belongsTo('App\Models\Student');
    }

    public function instance(){
        return $this->belongsTo('App\Models\Instance');
    }
}
