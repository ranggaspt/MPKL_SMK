<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;
    protected $table = 'studies';
    protected $primaryKey = 'id';

    protected $fillable =[
        'name',
    ];

    public function classrooms(){
        return $this->hasMany('App\Models\Classroom');
    }
}
