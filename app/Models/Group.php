<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function staffs()
    {
    	return $this->morphedByMany(User::class, 'groupable');
    }

    public function modules()
    {
        return $this->morphedByMany(Module::class, 'groupable');
    }

    public function permissions()
    {
    	return $this->morphToMany(Permission::class, 'permissionable');
    }

    public function canAccess($module)
    {
        if (is_string($module)) {
            return $this->modules->contains('label', $module);
        }

        foreach ($module as $m) {
            if ($this->canAccess($m->label)) {
                return true;
            }
        }

        return false;
    }
}
