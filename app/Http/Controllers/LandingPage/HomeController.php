<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $profile = $this->getProfile();
        $banner = $this->getBanner();
        $position = ['position' => 'Pengasuh,Kepala Madrasah,Kepala Pondok'];
        $employee = $this->getEmployee($position);

        $almbums = $this->getAlbum(3, 'id');
        $title = 'Beranda';

        return view('landing-page.home', compact('profile', 'banner', 'employee', 'almbums', 'title'));
    }

    public function albumShow($uuid)
    {
        $profile = $this->getProfile();

        $album = $this->getAlbumShow($uuid);
        $title = 'Album';
        return view('landing-page.album-show', compact('profile', 'album', 'title'));
    }
    public function getProfile()
    {
        $profile = Cache::remember('boarding-school-profile2', now()->addHours(24), function () {
            return app('App\Helpers\BoardingSchool')->profile();
        });
        return $profile->data;
    }

    public function blog()
    {
        $profile = $this->getProfile();
        $title = 'Blog';

        $blog = $this->getBlog();

        return view('landing-page.blog', compact('profile', 'title', 'blog'));
    }

    public function blogShow($slug, $uuid)
    {
        $profile = $this->getProfile();
        $title = 'Blog';

        $blog = $this->getBlogShow($uuid);


        return view('landing-page.blog-show', compact('profile', 'title', 'blog'));
    }

    public function contact()
    {
        $profile = $this->getProfile();
        $title = 'Contact';

        return view('landing-page.contact', compact('profile', 'title'));
    }

    public function alumni()
    {
        $profile = $this->getProfile();
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
        return redirect()->back()->with('success', 'Alumni sent successfully');
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

    public function getBlog()
    {
        $blog = Cache::remember('boarding-school-blog', now()->addHours(24), function () {
            return app('App\Helpers\BoardingSchool')->blog();
        });
        return $blog->data;
    }

    public function getBlogShow($uuid)
    {
        $blog = Cache::remember('boarding-school-blog-show', now()->addHours(24), function () use ($uuid) {
            return app('App\Helpers\BoardingSchool')->blogShow($uuid);
        });

        return $blog->data;
    }

    public function facility()
    {
        $profile = $this->getProfile();
        $title = 'Fasilitas';
        $facility = $this->getFacility();

        return view('landing-page.facility', compact('profile', 'title', 'facility'));
    }

    public function getFacility()
    {
        $facility = Cache::remember('boarding-school-facility', now()->addHours(24), function () {
            return app('App\Helpers\BoardingSchool')->facility();
        });
        return $facility->data;
    }

    public function getBanner()
    {
        $banner = Cache::remember('boarding-school-banner2', now()->addHours(24), function () {
            return app('App\Helpers\BoardingSchool')->banner();
        });
        return $banner->data;
    }

    public function getAlbumShow($uuid)
    {
        $album = Cache::remember('boarding-school-album-show', now()->addHours(24), function () use ($uuid) {
            return app('App\Helpers\BoardingSchool')->albumShow($uuid);
        });
        return $album->data;
    }

    public function getEmployee($position = [])
    {
        $employee =  app('App\Helpers\BoardingSchool')->employee($position);
        return $employee->data;
    }

    public function getAlbum($limit, $orderByType)
    {
        $album =  app('App\Helpers\BoardingSchool')->album($limit, $orderByType);
        return $album->data;
    }

    public function clear()
    {
        Cache::clear();
        return response()->json([
            'message' => 'Cache Berhasil Dihapus'
        ], 200);
    }
}
