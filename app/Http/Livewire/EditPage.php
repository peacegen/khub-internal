<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;

class EditPage extends Component
{
    public $urlslug;
    public $page;

    public $title;
    public $content;
    public $slug;
    public $tags = [];

    public function mount($urlslug = null)
    {
        $this->urlslug = $urlslug;
    }

    public function loadModel($slug)
    {
        $model = Page::where('slug', $slug)->first();
        $this->page = $model;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->content = $model->content;
        $this->tags = $model->tags;
    }

    /**
     * Loads all Tags in a list
     */
    public function tag_list(){
        return Tag::all()->pluck('name')->toArray();
    }
    
    public function cancel(){
        return redirect()->route('pages.index');
    }


    public function render()
    {
        $this->loadModel($this->urlslug);
        return view('livewire.edit-page')->layout('layouts.frontpage');
    }
}
