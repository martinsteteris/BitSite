<?php

namespace App\Models;

use Illuminate\Support\Facades\Date;

class Article
{
    private string $title;
    private string $link;
    private string $linkToImage;
    private string $description;
    private string $publishedAt;

    public function __construct(string $title, string $link, string $linkToImage, string $description, string $publishedAt)
       {
           $this->title = $title;
           $this->link = $link;
           $this->linkToImage = $linkToImage;
           $this->description = $description;
           $this->publishedAt = $publishedAt;
       }

    public function getLinkToImage(): string
    {
        return $this->linkToImage;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}



