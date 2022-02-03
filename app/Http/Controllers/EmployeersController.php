<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class EmployeersController extends Controller
{
    //


    public function update(Request $request)
    {
        $employee = employee::add([$request['firstname'], $request['patronomic'], $request['lastname'], $request['specialization']]);
        $employee->uploadImage($request->file('avatar'));
        $employee::setSkill($employee, $request['skill']);
        return redirect()->action('StartWebController@get');
    }

    public function store(Request $request)
    {
    $isEdit=0;
        Log::info($request->file());
//Log::info($request);
        if ($request['id'] == 0) {
            $employee = employee::add([$request['firstname'], $request['patronomic'], $request['lastname'], $request['specialization']]);
        } else {
            Employee::find($request['id'])->edit([$request['firstname'], $request['patronomic'], $request['lastname'], $request['specialization']]);
            $employee = Employee::find($request['id']);
            $isEdit=1;
        }
        if (!empty($request->file('avatar'))) {
            $employee->uploadImage($request->file('avatar'));
        }
        $employee::setSkill($employee, $request['skill']);
      //  Log::info($request->file());
        $data = [
            'id' => $employee->id,
            'firstname' => $employee->first_name,
            'lastname' => $employee->last_name,
            'patronomic' => $employee->patronomic,
            'specialization' => $employee->specialization->title,
            'skill' => $employee->getSkillsTitles(),
            'image_url' => $employee->getImage(),
            '_token' => $request['_token'],
        'isEdit'=>$isEdit
        ];
        return $data;
    }

    public function destroy($id)
    {

        Log::info('1');
        $data = Employee::find($id)->remove();
        return $data;
    }

    public function show($id)
    {
        $specializations = Specialization::all();
        $employee = Employee::find($id);
        return view('viewemployer', ['specializations' => $specializations, 'employee' => $employee]);
    }
}



