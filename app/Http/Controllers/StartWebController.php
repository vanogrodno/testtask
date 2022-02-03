<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartWebController extends Controller
{
    //


    public function get()
    {

        $specializations = Specialization::all();

        $employees = Employee::all();
        return view('welcome', ['specializations' => $specializations,'employees'=>$employees]);

    }

    public function show($id)
    {

        $specializations = Specialization::all();

        $employee = Employee::find($id);

        return view('viewemployer', ['specializations' => $specializations,'employee'=>$employee]);

    }
}
