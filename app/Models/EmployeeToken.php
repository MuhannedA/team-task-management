<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_token',
        'employee_id',  
    ];

    public function employeetokens(){
        return $this->belongsTo(Employee::class);
    }

}
