<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'instance_id',
        'teacher_id',
        'list_jurnals',
        'tanggal',
        'validation_jurnal',
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
