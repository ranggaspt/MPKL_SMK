<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
        'name',
        'instance_name',
        'instance_address',
        'photo', 
        'email',
        'phone'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
    
    public function complaintI(){
        return $this->belongsTo('App\Models\Complaint');
    }

    // public function monitoring(){
    //     return $this->hasMany('App\Models\Student');
    // }

    // public function packages(){
    //     return $this->hasMany('App\Models\Package');
    // }
    
}
