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
