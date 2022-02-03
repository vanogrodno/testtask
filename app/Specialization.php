<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    public function employeers()
    {
        return $this->hasMany(Employee::class);
    }

}
