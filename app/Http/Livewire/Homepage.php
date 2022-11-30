<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;
use PHPUnit\Framework\Constraint\IsEmpty;


class Homepage extends Component
{
    public $pages;
    public $tags;

    public function loadPages() {
        // TODO add loading by tag
        $pages = Page::where('has_tags', false)->get();
        return ['name' => __('Uncategorized'), 'description' => __('No Description'), 'items' => $pages, 'slug' => 'uncategorized'];
    }

    public function loadPagesByTag() {
        $this->tags = Tag::all();
        // dd($this->tags);
        foreach ($this->tags as $tag) {
            if($tag->pages->count() > 0) {
                $this->pages[$tag->name] = ['name' => $tag->name,
                'description' => $tag->description,
                'slug' => $tag->slug,
                'items' => $tag->pages];
            }
        }
        $pages = $this->loadPages();
        if ($pages['items']->count() > 0){
            $this->pages['Uncategorized'] = $pages;
        }


        return $this->pages;
    }

    public function render()
    {
        $data = $this->loadPagesByTag();

        return view('livewire.homepage', [
            'data' => $data
        ]);
    }
}
