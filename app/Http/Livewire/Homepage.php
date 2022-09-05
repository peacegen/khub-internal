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
        return ['name' => __('Uncategorized'), 'description' => __('No Description'), 'items' => $pages];
    }

    public function loadPagesByTag() {
        $this->tags = Tag::all();
        // dd($this->tags);
        foreach ($this->tags as $tag) {
            if($tag->pages->count() > 0) {
                $this->pages[$tag->name] = ['name' => $tag->name, 'description' => $tag->description, 'items' => $tag->pages];
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
    //     $items = [[
    //         'content' => "test",
    //         'image-url' => "https://via.placeholder.com/150",
    //     ],
    //     [
    //         'content' => "test1",
    //         'image-url' => null,
    //     ]
    // ];
        $data = $this->loadPagesByTag();

        // dd($data);
        return view('livewire.homepage', [
            'data' => $data
        ]);
    }
}
