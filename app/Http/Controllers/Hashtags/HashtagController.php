<?php

namespace App\Http\Controllers\Hashtags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    public function index()
    {
        // get all rows from trending_topics table
        $hashtags = \DB::table('trending_topics')->get();
        // convert to json
        $hashtags = json_encode($hashtags);
        return view('hashtags.index')->with('hashtags', $hashtags);
    }

    public function show($hashtag)
    {
        return view('hashtags.show')->with('hashtag', $hashtag);
    }
}
