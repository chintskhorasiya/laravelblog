<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title = "Home Page";
    	return view('pages.index', compact('title'));
    }

    public function about(){
    	$title = "About us";
    	return view('pages.about', compact('title'));
    }

    public function services(){
    	$data = array(
    		'title' => "Services",
    		'services' => ['Web Developement', 'Mobile Application Developement', 'SEO', 'Internet marketing']
    	);
    	return view('pages.services')->with($data);
    }
}
