<?php

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = POst::all();
        return vieq('posts',  compact('posts'));
    }
}


