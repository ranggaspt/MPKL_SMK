<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    protected $primaryKey = 'id';

    protected $fillable =[
        'study_id',
        'name',
    ];

    public function study(){
        return $this->belongsTo('App\Models\Study');
    }
}
