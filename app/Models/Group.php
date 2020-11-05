<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staffs()
    {
    	return $this->belongsToMany(User::class, 'group_user');
    }

    public function permissions()
    {
    	return $this->morphToMany(Permission::class, 'permissionable');
    }
}
