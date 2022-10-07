<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{
    public $title;
    public $content;
    public $urlslug;
    public $page;

    public function mount($urlslug=null)
    {
        $this->retrieveContent($urlslug);
    }

    public function retrieveContent($urlslug)
    {
        $customHome = true;

        if ($customHome) {
            if (empty($urlslug)) {
                return redirect()->route('/');
            } else {
                $this->page = Page::where('slug', $urlslug)->first();
                if (!$this->page) {
                    return abort(404);
                }
            }

            $this->attachments = array_map(fn($value) => $value->attachable, $this->page->content->attachments()->toArray());
        }


    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
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
