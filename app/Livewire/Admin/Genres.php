<?php

namespace App\Livewire\Admin;


use App\Models\Genre;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Genres extends Component
{
    // sort properties
    public $orderBy = 'name';
    public $orderAsc = true;

    #[Validate('required|min:3|max:30|unique:genres,name')]
    public $newGenre;

    // create a new genre
    public function create()
    {
        // validate the new genre name
        $this->validateOnly('newGenre');
        // create the genre
        Genre::create([
            'name' => trim($this->newGenre),
        ]);
    }

    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->orderAsc = !$this->orderAsc :
            $this->orderAsc = true;
        $this->orderBy = $column;
    }

    #[Layout('layouts.vinylshop', ['title' => 'Genres', 'description' => 'Manage the genres of your vinyl records',])]
    public function render()
    {
        $genres = Genre::withCount('records')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->get();
        return view('livewire.admin.genres', compact('genres'));
    }
}
