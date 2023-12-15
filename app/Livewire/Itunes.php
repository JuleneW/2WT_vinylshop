<?php

namespace App\Livewire;

use Http;
use Livewire\Component;
use App\Livewire\Album;

class Itunes extends Album
{
    public $album;
    public function showTopAlbums(Album, $album)
    {
        $this->selectedAlbum = $album;
        $url = "https://itunes.apple.com/search?term={$album->mb_id}?inc=recordings&fmt=json";
        $response = Http::get($url)->json();
    }
}
