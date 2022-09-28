<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\NewsApiRepository;


class NewsApiController extends Controller
{
    public function index()
    {
        $articles = new NewsApiRepository();
        return view('news.index', ['articles' => $articles->request(),]);
    }

}
