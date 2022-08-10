<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{
    public $title;
    public $content;
    public $urlslug;

    public function mount($urlslug)
    {
        $this->retrieveContent($urlslug);

    }

    public function retrieveContent($urlslug)
    {
        $page = Page::where('slug', $urlslug)->first();
        $this->title = $page->title;
        $this->content = $page->content;
    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
