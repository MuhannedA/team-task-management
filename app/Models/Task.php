<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'unagree_descrition',
        'wait_task',
        'agree_task',
        'unagree_task',
        'done_task',
        'user_id',
        'employee_id',  
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
