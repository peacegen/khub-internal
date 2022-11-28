<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DownloadContainer extends Component
{
    public $file;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.download-container');
    }
}
