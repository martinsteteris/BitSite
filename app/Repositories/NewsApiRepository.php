<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\Http;

class NewsApiRepository
{
    public function request(): array {
        $response = Http::withHeaders([
            'X-RapidAPI-Key'=> '04b3ad893bmshed88a38cf48a96fp15c1f3jsndc3eac309e17',
            'X-RapidAPI-Host'=> 'crypto-news14.p.rapidapi.com.com'
        ])->get('https://crypto-news14.p.rapidapi.com/news/cointelegraph');
        $data = json_decode($response->getBody(), true);
        $articles = [];
        foreach ($data as $artice) {
            $articles[] = new Article(
                $artice['title'],
                $artice['url'],
                $artice['image'],
                $artice['desc'],
                $artice['date']
            );
        }
        return $articles;
    }
}
