<?php

namespace Apps\User\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public function roles()
    {
        return $this->belongsToMany(Product::class);
    }
    //
}
