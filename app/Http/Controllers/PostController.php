<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Response\SuccessResponse;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SuccessResponse::make('Success get posts', PostResource::collection(Post::all()));
    }


    /**
     * Show finded post
     */
    public function show(Post $post)
    {
        return SuccessResponse::make('Success get post', PostResource::make($post));
    }

}
