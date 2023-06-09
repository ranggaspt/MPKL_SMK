<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'description',
        'tanggal',
        'file',
    ];

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }

    public function student(){
        return $this->belongsTo('App\Models\Student');
    }

}
