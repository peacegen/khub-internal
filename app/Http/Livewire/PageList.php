<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Helpers\Helper;
use Illuminate\Support\Arr;
use Barryvdh\Debugbar\Facade as Debugbar;

class PageList extends Component
{
    public $search;
    public $pageList;
    public $selectedTags = [];
    public $tag_list;

    public function mount()
    {
        $this->tag_list = Helper::getTagNameArray();
        $this->selectedTags = [];
    }

    public function render()
    {
        Debugbar::info($this->selectedTags);
        if($this->selectedTags && $this->selectedTags[0] != ''){
            $this->pageList = Page::where('title', 'like', '%' . $this->search . '%')
                ->whereHas('tags', function ($query) {
                    $query->whereIn('name', Arr::wrap($this->selectedTags));
                })
                ->get();
        } else {
            $this->pageList = Page::where('title', 'like', '%' . $this->search . '%')->get();
        }
        // TODO add pagination
        return view('livewire.page-list')->with('pages', $this->pageList)->layout('layouts.frontpage');
    }
}
