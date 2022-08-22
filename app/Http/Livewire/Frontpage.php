<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{
    public $title;
    public $content;
    public $urlslug;

    public function mount($urlslug=null)
    {
        $this->retrieveContent($urlslug);

    }

    public function retrieveContent($urlslug)
    {
        $customHome = true;

        if ($customHome) {
            if (empty($urlslug)) {
                $page = Page::where('is_default_home', true)->first();
            } else {
                $page = Page::where('slug', $urlslug)->first();
                if (!$page) {
                    $page = Page::where('is_default_not_found', true)->first();
                }
            }

            $this->title = $page->title;
            $this->content = $page->content;
        }


    }

    private function sideNavLinks() {
        return ([new Link('Home', 'home'), new Link('About', 'about')]);
    }

    private function topNavLinks() {
        return ([new Link('Home', 'home'), new Link('About', 'about')]);
    }

    public function render()
    {
        return view('livewire.frontpage', [
            'sideBarLinks' => $this->sideNavLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])->layout('layouts.frontpage');
    }
}

class Link {
    public $slug;
    public $label;

    public function __construct($label, $slug)
    {
        $this->label = $label;
        $this->slug = $slug;
    }
}
