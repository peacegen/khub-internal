<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Validation\Rule;

class PageForm extends Component
{
    /**
     * The component's page
     */
    public $page;
    public $urlslug;

    public $title;
    public $content;
    public $slug;
    public $tags = [];



    protected $rules = [
        'page.title' => 'required',
        'page.slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
    ];


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($urlslug)
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->loadModel($this->urlslug);
        return view('components.page-form');
    }
}
