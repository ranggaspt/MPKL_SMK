<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_identity',
        'user_id',
        'classroom_id',
        'instance_id',
        'teacher_id',
        'name',
        'gender',
        'address',
        'photo',
        'email',
        'phone'
    ];
    protected $nullable = [
		'photo',
	];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom');
    }

    public function instance(){
        return $this->belongsTo('App\Models\Instance');
    }

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
}
