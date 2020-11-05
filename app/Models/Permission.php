<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function roles()
    {
    	return $this->morphedByMany(Role::class, 'permissionable');
    }

    public function groups()
    {
    	return $this->morphedByMany(Group::class, 'permissionable');
    }
}
