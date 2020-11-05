<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function groups()
    {
    	return $this->morphToMany(Group::class, 'groupable');
    }

    public function addTo(Group $group)
    {
    	return $this->groups()->save($group);
    }
}
