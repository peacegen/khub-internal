<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class PageList extends Component
{
    public $search;
    public $pageList;

    public function render()
    {
        // TODO add pagination
        $this->pageList = Page::whereLike('title', $this->search ?? '')->get();
        return view('livewire.page-list')->with('pages', $this->pageList)->layout('layouts.frontpage');
    }
}
