<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Group;
use App\Models\Department;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }

    public function actAs(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('label', $role);
        }

        foreach ($role as $r) {
            if ($this->hasRole($r->label)) {
                return true;
            }
        }

        return false;
    }

    public function departments()
    {
        return $this->morphToMany(Department::class, 'departmentable');
    }

    public function addTo(Department $department)
    {
        return $this->departments()->save($department);
    }

    public function distinguishedBy($department)
    {
        if (is_string($department)) {
            return $this->departments->contains('code', $department);
        }

        foreach ($department as $d) {
            if ($this->distinguishedBy($d->code)) {
                return true;
            }
        }

        return false;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function attachTo(Group $group)
    {
        return $this->groups()->save($group);
    }

    public function groupedBy($group)
    {
        if (is_string($group)) {
            return $this->groups->contains('label', $group);
        }

        foreach ($group as $g) {
            if ($this->groupedBy($g->label)) {
                return true;
            }
        }

        return false;
    }
}
