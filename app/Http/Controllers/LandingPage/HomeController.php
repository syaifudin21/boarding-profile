<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $banner = app('App\Helpers\BoardingSchool')->banner();
        $position = ['position' => 'Pengasuh,Kepala Madrasah,Kepala Pondok'];
        $employee = app('App\Helpers\BoardingSchool')->employee($position);

        $almbums = app('App\Helpers\BoardingSchool')->album(3, 'id');
        $title = 'Beranda';

        return view('landing-page.home', compact('profile', 'banner', 'employee', 'almbums', 'title'));
    }

    public function albumShow($uuid)
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();

        $album = app('App\Helpers\BoardingSchool')->albumShow($uuid);
        $title = 'Album';
        return view('landing-page.album-show', compact('profile', 'album', 'title'));
    }

    public function blog()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Blog';

        $blog = app('App\Helpers\BoardingSchool')->blog();

        return view('landing-page.blog', compact('profile', 'title', 'blog'));
    }

    public function blogShow($slug, $uuid)
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Blog';

        $blog = app('App\Helpers\BoardingSchool')->blogShow($uuid);


        return view('landing-page.blog-show', compact('profile', 'title', 'blog'));
    }

    public function contact()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Contact';

        return view('landing-page.contact', compact('profile', 'title'));
    }

    public function alumni()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Alumni';

        return view('landing-page.alumni', compact('profile', 'title'));
    }

    public function alumniStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $alumni = app('App\Helpers\BoardingSchool')->alumniStore($request->name, $request->position, $request->description, $request->photo);
        if ($alumni) {
            return redirect()->back()->with('success', $alumni->message);
        } else {
            return redirect()->back()->with('error', $alumni->message);
        }
    }

    public function messageStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $message = app('App\Helpers\BoardingSchool')->inboxStore($request->name, $request->email, $request->message);
        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function facility()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Fasilitas';
        $facility = app('App\Helpers\BoardingSchool')->facility();

        return view('landing-page.facility', compact('profile', 'title', 'facility'));
    }

    public function employee()
    {
        $profile = app('App\Helpers\BoardingSchool')->profile();
        $title = 'Pengurus';
        $employee = app('App\Helpers\BoardingSchool')->employee();

        return view('landing-page.employee', compact('profile', 'title', 'employee'));
    }

    public function clear()
    {
        Cache::clear();
        return response()->json([
            'message' => 'Cache Berhasil Dihapus'
        ], 200);
    }
}
