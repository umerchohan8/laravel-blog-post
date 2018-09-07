<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index()
	{
		$data = array(
			'title' => 'Welcome to Home page.' , 
			'body' 	=> 'This is my first Laravel Application. Following are my skills: -' ,
			'skills' => ['Designing', 'Web Development', 'SEO'] 
		);

    	return view('pages.index')->with($data);
	}



	public function features()
	{
		$data = array(
			'title' => 'Welcome to Features page.' , 
			'body' 	=> 'This is our Features page'
		);

    	return view('pages.features')->with($data);
	}



	public function enterprise()
	{
		$data = array(
			'title' => 'Welcome to Enterprise page.' , 
			'body' 	=> 'This is our Enterprise page'
		);

    	return view('pages.enterprise')->with($data);
	}



	public function about()
	{
		$data = array(
			'title' => 'Welcome to About Us page.' , 
			'body' 	=> 'This is our About Us page'
		);

    	return view('pages.about')->with($data);
	}
}
