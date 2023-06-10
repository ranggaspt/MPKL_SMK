<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'instance_id',
        'latitude',
        'longitude',
        'tanggal',
        'masuk',
        'pulang',
    ];

    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
    public function instance(){
        return $this->belongsTo('App\Models\Instance');
    }
}
