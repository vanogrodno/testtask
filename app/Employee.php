<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Employee extends Model
{


    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function skills()
    {
        return $this->belongsToMany(
            Skill::class,
            'employee_skill',
            'employee_id',
            'skill_id'
        );
    }

    public static function add($fields)
    {
        $employee = new static;
        //  $employee->fill($fields);
        $employee->first_name = $fields[0];
        $employee->patronomic = $fields[1];
        $employee->last_name = $fields[2];
        $employee->specialization_id = $fields[3];
        $employee->save();
        return $employee;
    }

    public function edit($fields)
    {
        $this->first_name = $fields[0];
        $this->patronomic = $fields[1];
        $this->last_name = $fields[2];
        $this->specialization_id = $fields[3];
        $this->save();
    }

    public function remove()
    {
//сначало удаляем картинку
        Storage::delete('uploads/', $this->image);
        $this->delete();
    }

    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }
        //удаление предыдущей картинки
        if ($this->image != null) {
            Storage::delete('uploads/' . $this->image);
        }

        //генерим рандмоное имя

        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function setSpecialization($id)
    {
        if ($id == null) {
            return;
        }
        $this->specializaton_id = $id;
        $this->save();

    }

    public static function setSkill($employee, $skillstext)
    {
        if ($skillstext == null) {
            return;
        }
        $ids = [];
        $skills = explode(",", $skillstext);

        foreach ($skills as $skill) {

            $ids[] = Skill::add(trim($skill));

        }
        // dd($employee);

        $employee->skills()->sync($ids);
    }

    public function getImage()
    {
        //если картинки нет тогда выводим дефолтную картинку
        if ($this->image == null) {
            return 'img/no-image.png';
        }
        return 'http://testtask/uploads/' . $this->image;
    }

    public function getSkillsTitles()
    {
        if (!$this->skills->isEmpty()) {
            return implode(',', $this->skills->pluck('title')->all());
        }
        return 'Нет тегов';
    }
}

