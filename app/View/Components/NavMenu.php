<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavMenu extends Component
{

    //the array to hold the links
    public $links = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getSideBarLinks(){
        return [[
            'label' => 'Home',
            'url' => url('home'),
        ],
        [
            'label' => 'Settings',
            'url' => url('settings'),
        ]];
    }

    public function getTopNavLinks(){
        $links = [[
            'label' => __('Home'),
            'url' => url('/'),
        ],
        [
            'label' => __('Pages'),
            'url' => url('pages'),
        ]];
        //check if user is already logged in
        if (Auth::check()) {
            //if user is logged in, show logout link
            // add to links array
            $links[] = [
                'label' => __('Logout'),
                'url' => url('logout'),
            ];

        } else {
            //if user is not logged in, show login link
            $links[] = [
                'label' => __('Login'),
                'url' => url('login'),
            ];
            $links[] = [
                'label' => __('Register'),
                'url' => url('register'),
            ];
        }
        return $links;
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
