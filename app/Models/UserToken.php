<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_token',
        'user_id',  
    ];

    public function usertokens(){
        return $this->belongsTo(User::class);
    }
}
