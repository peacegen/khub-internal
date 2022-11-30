<?php

namespace App\Http\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavMenu extends Component
{
    //the array to hold the links
    public $links = [];
    public $loginModalVisible = false;


    public function links(){
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
        }

        $links[] = [
            'label' => __('Pages'),
            'url' => url('pages'),
        ];

        Debugbar::info($links);

        return $links;
    }

    public function render()
    {
        return view('livewire.nav-menu', [
            'navLinks' => $this->links(),
        ]);
    }
}
