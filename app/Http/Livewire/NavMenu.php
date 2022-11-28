<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavMenu extends Component
{
    //the array to hold the links
    public $links = [];
    public $loginModalVisible = false;


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
            // $links[] = [
            //     'label' => __('Login/Register'),
            //     'url' => route('auth'),
            // ];
            // $links[] = [
            //     'label' => __('Register'),
            //     'url' => route('register'),
            // ];
        }
        return $links;
        }

    public function render()
    {
        return view('livewire.nav-menu', [
            'sideBarLinks' => $this->getSideBarLinks(),
            'topNavLinks' => $this->getTopNavLinks(),
        ]);
    }
}
