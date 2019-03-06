<?php

namespace Apps\User\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
