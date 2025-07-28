<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Hero;
use App\Models\Sermon;
use App\Models\Setting;
use App\Models\Overview;
use App\Models\Solution;
use App\Models\Menu;
use App\Models\Doc;
use App\Models\Detail;
use App\Models\Background;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Quick;
use App\Models\Testimony;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        // Fetch heroes data
        $heroes = Hero::all();
        $solution = Solution::all();
        $overview = Overview::all();
        $background = Background::all();
        $menu = Menu::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();






        return view('welcome', compact('generalSettings','heroes','solution','overview','background','menu'));
    }

        public function about_us()

    {
        // Fetch heroes data
        $heroes = Hero::all();
        $solution = Solution::all();
        $overview = Overview::all();
        $background = Background::all();
                $menu = Menu::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();

        $agent = new Agent();

        if ($agent->isMobile()) {
            // Load a separate view for mobile devices
            // return view('mobile_welcome', compact('heroes', 'generalSettings', 'displaySettings','update','news','contact','broadcasts','quicks','leaders','similarMinistries','donate','us'));
            return view('mobile_welcome', compact('generalSettings'));
        }

        return view('about_us', compact('generalSettings','heroes','solution','overview','background','menu'));
    }


    public function custom()

    {
        // Fetch heroes data
        $heroes = Hero::all();
        $documentation = Doc::all();
        $solution = Solution::all();
        $overview = Overview::all();
        $background = Background::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();

        $agent = new Agent();

        if ($agent->isMobile()) {
            // Load a separate view for mobile devices
            // return view('mobile_welcome', compact('heroes', 'generalSettings', 'displaySettings','update','news','contact','broadcasts','quicks','leaders','similarMinistries','donate','us'));
            return view('mobile_welcome', compact('generalSettings'));
        }

        return view('custom', compact('generalSettings','heroes','solution','overview','background','documentation'));
    }

    public function contact()

    {
        // Fetch heroes data
        $heroes = Hero::all();
        $documentation = Doc::all();
        $solution = Solution::all();
        $overview = Overview::all();
        $background = Background::all();
        $detail = Detail::all();
                $menu = Menu::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();




        return view('contact', compact('generalSettings','heroes','solution','overview','background','documentation','detail','menu'));
    }



    public function easy()

    {
        // Fetch heroes data
        $heroes = Hero::all();
        $documentation = Doc::all();
        $solution = Solution::all();
        $overview = Overview::all();
        $background = Background::all();
        $detail = Detail::all();
                $menu = Menu::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();


        return view('laravel_easy', compact('generalSettings','heroes','solution','overview','background','documentation','detail','menu'));
    }


    public function attendance()

    {
        return view('attendance_register');
    }

}
