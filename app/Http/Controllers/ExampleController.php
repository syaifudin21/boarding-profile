<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        return view('example.index');
    }

    public function profile()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        return $profile;
    }

    public function album()
    {
        $album = app('App\Helpers\BoardingSchool')->album();
        return $album;
    }

    public function albumShow($uuid)
    {
        $album = app('App\Helpers\BoardingSchool')->albumShow($uuid);
        return $album;
    }

    public function employee()
    {
        $employee = app('App\Helpers\BoardingSchool')->employee();
        return $employee;
    }

    public function banner(Request $request)
    {
        $banner = app('App\Helpers\BoardingSchool')->banner($request);
        return $banner;
    }


    public function alumni(Request $request)
    {
        $alumni = app('App\Helpers\BoardingSchool')->alumni($request);
        return $alumni;
    }
}
