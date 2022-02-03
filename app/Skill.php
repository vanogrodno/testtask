<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function employeers()
    {
        return $this0->belongsToMany(
            Employee::class,
            'employee_skill',
            'skill_id',
            'employee_id'
        );
    }

    public static function add($title)
    {
        $skill = new static;
        $skill->title = $title;
        $skill->save();
        return  $skill->id;

    }
}
