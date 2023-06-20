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

    public function attendanceCount()
    {
        return $this->hasMany(Attendance::class)->count();
    }
    public function reportCount()
    {
        return $this->hasMany(Report::class)->count();
    }
    public function complaintCount()
    {
        return $this->hasMany(Complaint::class)->count();
    }
    public function journalCount()
    {
        return $this->hasMany(Journal::class)->count();
    }
    public function studentCount()
    {
        return $this->hasMany(Student::class)->count();
    }
    
}
