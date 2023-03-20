<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_identity',
        'user_id',
        'name',
        'address',
        'photo',
        'email',
        'phone'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // public function packages(){
    //     return $this->hasMany('App\Models\Package');
    // }
}
