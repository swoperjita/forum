<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBlock extends Model
{
    protected $fillable = ['blocked_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
