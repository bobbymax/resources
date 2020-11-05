<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staffs()
    {
    	return $this->morphedByMany(User::class, 'roleable');
    }

    public function permissions()
    {
    	return $this->morphToMany(Permission::class, 'permissionable');
    }

    public function grant(Permission $permission)
    {
    	return $this->permissions()->save($permission);
    }

    public function hasPermission($permission)
    {
    	if (is_string($permission)) {
    		return $this->permissions->contains('label', $permission);
    	}

    	foreach ($permission as $p) {
    		if ($this->hasPermission($p->label)) {
    			return true;
    		}
    	}

    	return false;
    }
}
