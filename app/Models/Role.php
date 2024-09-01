<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /* 
    * * * * * * * * 

    // Kullanıcıya rol atama
    $user = User::find(1);
    $role = Role::find(2);
    $user->roles()->attach($role->id);

    // Kullanıcıdan rol kaldırma
    $user->roles()->detach($role->id);

    // Kullanıcının rollerini alma
    $roles = $user->roles;
    
    * * * * * * * * *
    */
}
