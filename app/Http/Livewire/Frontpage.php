<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Barryvdh\Debugbar\Facades\Debugbar;

class Frontpage extends Component
{
    public $title;
    public $content;
    public $urlslug;
    public $page;
    public $attachments = [];

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

            $media = $this->page->getMedia('files');
            foreach ($media as $attachment) {
                $this->attachments[] = $attachment;
            }
        }


    }

    public function render()
    {
        return view('livewire.frontpage');
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
