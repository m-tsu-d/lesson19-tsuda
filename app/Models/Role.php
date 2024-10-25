<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //この役割が属するユーザー
    public function users()
    {
        return $this->belongsToMany('App\Models\User','role_user', 'role_id','user_id')->withTimestamps();
    }
}
