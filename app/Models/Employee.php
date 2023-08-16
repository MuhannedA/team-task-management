<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id'
    ];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tokenEmployee(){
        return $this->hasOne(EmployeeToken::class);
    }
}
