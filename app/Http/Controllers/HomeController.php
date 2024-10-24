<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $lastestJobs = Job::orderBy('created_at', 'DESC')->limit(12)->get();
        $randomJobs = Job::inRandomOrder()->limit(12)->get();

        return view('front.home', compact('categories', 'lastestJobs', 'randomJobs'));
    }
    public function contact()
    {
        return view('front.contact');
    }
}
