<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;

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
        $links = [];

        // if user is admin, add the admin link
        if(Auth::check()) {
            $links[] = [
                'label' => __('Profile'),
                'url' => route('profile.show'),
            ];
            $user = Auth::user();
            if($user->hasRole(['admin', 'super-admin'])){
                $links[] = [
                    'label' => __('Admin'),
                    'url' => url('admin'),
                ];

                // if user is on a page, add the edit link
                if(Route::currentRouteName() == 'page.show'){
                    $links[] = [
                        'label' => __('Edit Page'),
                        'url' => url('/pages/' . Route::current()->parameter('urlslug') . '/edit'),
                    ];
                }
            }


            if($user->can('view pages')){
                $links[] = [
                    'label' => __('Pages'),
                    'url' => route('edit-pages'),
                ];
            }
            
            if($user->can('view users')){
                $links[] = [
                    'label' => __('Users'),
                    'url' => route('edit-users'),
                ];
            }

            if($user->can('view roles')){
                $links[] = [
                    'label' => __('Roles'),
                    'url' => route('edit-roles'),
                ];
            }


            if($user->can('view tags')){
                $links[] = [
                    'label' => __('Tags'),
                    'url' => route('edit-tags'),
                ];
            }
        }

        return $links;
    }

    public function getTopNavLinks(){
        $links = [[
            'label' => __('Pages'),
            'url' => url('pages'),
        ]]; //start with the pages link


        //check if user is already logged in
        if (Auth::check()) {
            //if user is logged in, show logout link
            $links[] = [
                'label' => __('Logout'),
                'url' => 'logout',
            ];
        } else {
            //if user is not logged in, show login link
            $links[] = [
                'label' => __('Login'),
                'url' => route('auth'),
            ];
            $links[] = [
                'label' => __('Register'),
                'url' => route('register'),
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

