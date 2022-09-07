<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getSideBarLinks(){
        return ([new Link('Home', url('home')), new Link('Settings', url('settings'))]);
    }

    public function getTopNavLinks(){
        return ([new Link('Pages', url('pages')), new Link('Root', url('/'))]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-menu', [
            'sideBarLinks' => $this->getSideBarLinks(),
            'topNavLinks' => $this->getTopNavLinks(),
        ]);
    }
}

class Link {
    public $url;
    public $label;

    public function __construct($label, $url)
    {
        $this->label = $label;
        $this->url = $url;
    }
}
